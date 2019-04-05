using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Net.NetworkInformation;
using System.Diagnostics;
using Microsoft.VisualBasic.Devices;
using System.Net;
using System.Net.Sockets;
using System.Threading;
using System.Runtime.InteropServices;

namespace Server
{
    class Program {
        //App Variables
        static string[] excludeddescriptions = { "VMware", "VirtualBox", "Loopback" };
        static string client;
        static string ip;
        static string CompName;
        static bool started = false;
        static Thread childthread;
        //static string[] excludeddescriptions = { };
        //exit Handler
        static bool exitSystem = false;
        [DllImport("Kernel32")]
        private static extern bool SetConsoleCtrlHandler(EventHandler handler, bool add);
        private delegate bool EventHandler(CtrlType sig);
        static EventHandler _handler;
        enum CtrlType
        {
            CTRL_C_EVENT = 0,
            CTRL_BREAK_EVENT = 1,
            CTRL_CLOSE_EVENT = 2,
            CTRL_LOGOFF_EVENT = 5,
            CTRL_SHUTDOWN_EVENT = 6
        }
        private static bool Handler(CtrlType sig)
        {
            Console.Clear();
            Console.WriteLine("Cleaning Up...");
            if (started)
            {
                Console.WriteLine("Sending GoodBy Message...");
                alert("OFF", client, ip, CompName);
                childthread.Suspend();
            }
            System.Threading.Thread.Sleep(1000);
            Console.WriteLine("Clean Up successfull...");
            System.Threading.Thread.Sleep(500);
            exitSystem = true;
            Environment.Exit(-1);
            return true;
        }
        static void show(string ip)
        {
            PerformanceCounter cpuCounter;
            PerformanceCounter ramCounter;
            ComputerInfo info = new ComputerInfo();
            NetworkInterface[] interfaces = NetworkInterface.GetAllNetworkInterfaces();
            cpuCounter = new PerformanceCounter("Processor", "% Processor Time", "_Total");
            ramCounter = new PerformanceCounter("Memory", "Available MBytes");
            long[] previusreceivednpacket = new long[interfaces.Length];
            long[] previussentpacket = new long[interfaces.Length];
            for (int i = 0; i < interfaces.Length; i++)
            {
                previusreceivednpacket[i] = interfaces[i].GetIPStatistics().BytesReceived;
                previussentpacket[i] = interfaces[i].GetIPStatistics().BytesSent;
            }
            while (true)
            {
                Console.WriteLine("Binded Address: " + ip);
                Console.WriteLine("----CPU----");
                Console.WriteLine(string.Format("usage: {0}%", cpuCounter.NextValue().ToString("0.00")));
                Console.WriteLine("----RAM----");
                Console.WriteLine(((info.TotalPhysicalMemory / 1024) / 1024 - ramCounter.NextValue()) + "MB / "+(info.TotalPhysicalMemory/1024)/1024+"MB");
                for(int i=0; i<interfaces.Length; i++)
                {
                    if(interfaces[i].OperationalStatus == OperationalStatus.Up && !excludeddescriptions.Any(interfaces[i].Description.Contains))
                    {
                        Console.WriteLine("----Network Interface----");
                        Console.WriteLine(interfaces[i].Name + ":");
                        Console.WriteLine(" Description: " + interfaces[i].Description);
                        Console.WriteLine(" KBytes Received: " + (interfaces[i].GetIPStatistics().BytesReceived - previusreceivednpacket[i]));
                        Console.WriteLine(" KBytes Sent: " + (interfaces[i].GetIPStatistics().BytesSent - previussentpacket[i]));
                        Console.WriteLine(" Total KBytes Received: " + interfaces[i].GetIPStatistics().BytesReceived);
                        Console.WriteLine(" Total KBytes Sent: " + interfaces[i].GetIPStatistics().BytesSent);
                        Console.WriteLine(" Interface Max Speed: " + interfaces[i].Speed);
                        previusreceivednpacket[i] = interfaces[i].GetIPStatistics().BytesReceived;
                        previussentpacket[i] = interfaces[i].GetIPStatistics().BytesSent;
                    }
                }
                System.Threading.Thread.Sleep(500);
                Console.Clear();
            }
        }
        static void alert(string type, string client, string ip, string CompName)
        {
            //set if app is started
            if(type == "ON")
            {
                started = true;
            }
            else
            {
                started = false;
            }
            //send alert
            IPAddress clientip = IPAddress.None;
            try
            {
                clientip = IPAddress.Parse(client);
            }
            catch (Exception)
            {
                Console.Clear();
                Console.WriteLine("Client IP is Invalid");
                Thread.Sleep(2000);
                Environment.Exit(0);
            }
            IPEndPoint remoteEP = new IPEndPoint(clientip, 11100);
            Socket sender = new Socket(clientip.AddressFamily, SocketType.Stream, ProtocolType.Tcp);
            try
            {
                sender.Connect(remoteEP);
                sender.Send(Encoding.ASCII.GetBytes(type+"\\"+CompName+"\\"+ip));
                sender.Shutdown(SocketShutdown.Both);
                sender.Close();
            }
            catch (Exception )
            {
                
            }
        }
        static void Main(string[] args)
        {
            _handler += new EventHandler(Handler);
            SetConsoleCtrlHandler(_handler, true);
            Console.Write("Enter Client IP:");
            client = Console.ReadLine();
            Console.Clear();
            Console.Write("Enter IP address: ");
            ip = Console.ReadLine();
            Console.Clear();
            Console.Write("Enter Computer Name: ");
            CompName = Console.ReadLine();
            Console.Clear();
            List<string> interfacelist = new List<string>();
            List<string[]> actionlist = new List<string[]>();
            childthread = new Thread(()=>show(ip));
            childthread.Start();
            alert("ON",client, ip, CompName);
            PerformanceCounter cpuCounter;
            PerformanceCounter ramCounter;
            ComputerInfo info = new ComputerInfo();
            NetworkInterface[] interfaces= NetworkInterface.GetAllNetworkInterfaces();
            cpuCounter = new PerformanceCounter("Processor", "% Processor Time", "_Total");
            ramCounter = new PerformanceCounter("Memory", "Available MBytes");
            long[] previusreceivednpacket = new long[interfaces.Length];
            long[] previussentpacket = new long[interfaces.Length];
            for (int i = 0; i < interfaces.Length; i++)
            {
                previusreceivednpacket[i] = interfaces[i].GetIPStatistics().BytesReceived;
                previussentpacket[i] = interfaces[i].GetIPStatistics().BytesSent;
            }
            for (int i=0; i<interfaces.Length; i++)
            {
                    previusreceivednpacket[i] = interfaces[i].GetIPStatistics().BytesReceived;
                    previussentpacket[i] = interfaces[i].GetIPStatistics().BytesSent;
            }
            
            while (true)
            {
                foreach(string[] action in actionlist)
                {
                    if(action[0] == "CPU")
                    {
                        if (action[1] == "BT")
                        {
                            if (Int32.Parse(action[2]) < cpuCounter.NextValue())
                            {
                                if(action[3] == "CMD")
                                {
                                    Process.Start("CMD.exe", "/C "+ action[4]);
                                }
                            }
                        }
                        else if(action[1] == "ST")
                        {
                            if (Int32.Parse(action[2]) > cpuCounter.NextValue())
                            {
                                if (action[3] == "CMD")
                                {
                                    Process.Start("CMD.exe", "/C " + action[4]);
                                }
                            }
                        }
                        else if(action[1] == "ET")
                        {
                            if (Int32.Parse(action[2]) == cpuCounter.NextValue())
                            {
                                if (action[3] == "CMD")
                                {
                                    Process.Start("CMD.exe", "/C " + action[4]);
                                }
                            }
                        }
                    }
                    else if(action[0] == "RAM")
                    {
                        if (action[1] == "BT")
                        {
                            if (Int32.Parse(action[2]) < ramCounter.NextValue())
                            {
                                if (action[3] == "CMD")
                                {
                                    Process.Start("CMD.exe", "/C " + action[4]);
                                }
                            }
                        }
                        else if (action[1] == "ST")
                        {
                            if (Int32.Parse(action[2]) > ramCounter.NextValue())
                            {
                                if (action[3] == "CMD")
                                {
                                    Process.Start("CMD.exe", "/C " + action[4]);
                                }
                            }
                        }
                        else if (action[1] == "ET")
                        {
                            if (Int32.Parse(action[2]) == ramCounter.NextValue())
                            {
                                if (action[3] == "CMD")
                                {
                                    Process.Start("CMD.exe", "/C " + action[4]);
                                }
                            }
                        }
                    }
                }
                interfacelist.Clear();
                for (int i = 0; i < interfaces.Length; i++)
                {
                    if (interfaces[i].OperationalStatus == OperationalStatus.Up && !excludeddescriptions.Any(interfaces[i].Description.Contains))
                    {
                        interfacelist.Add(interfaces[i].Name+"*"+interfaces[i].Description + "*" + (interfaces[i].GetIPStatistics().BytesReceived - previusreceivednpacket[i]) + "*" + (interfaces[i].GetIPStatistics().BytesSent - previussentpacket[i]) + "*" + interfaces[i].GetIPStatistics().BytesReceived + "*" + interfaces[i].GetIPStatistics().BytesSent + "*" + interfaces[i].Speed);
                        previusreceivednpacket[i] = interfaces[i].GetIPStatistics().BytesReceived;
                        previussentpacket[i] = interfaces[i].GetIPStatistics().BytesSent;
                    }
                }
                IPAddress ipaddress = IPAddress.None;
                try
                {
                    ipaddress = IPAddress.Parse(ip);
                }
                catch (Exception)
                {
                    Console.Clear();
                    Console.WriteLine("Binded IP is Invalid");
                    Thread.Sleep(2000);
                    Environment.Exit(0);
                }
                
                
                byte[] bytes = new byte[1024];
                
                IPEndPoint localEndPoint = new IPEndPoint(ipaddress, 11000);
                try
                {
                    string message = cpuCounter.NextValue().ToString("0.00") + "*" + ramCounter.NextValue() + "*" + (info.TotalPhysicalMemory / 1024) / 1024;
                    foreach(string s in interfacelist)
                    {
                        message = message + ":" +s;
                    }
                    Socket listener = new Socket(ipaddress.AddressFamily, SocketType.Stream, ProtocolType.Tcp);
                    listener.Bind(localEndPoint);
                    listener.Listen(1);
                    Socket handler = listener.Accept();
                    byte[] rcv = new byte[1024];
                    handler.Receive(rcv);
                    string data = Encoding.UTF8.GetString(rcv);
                    string[] datasplt = data.Split('.');
                    data = datasplt[0];
                    string[] datasplt2 = data.Split(':');
                    string data2 = datasplt2[0];
                    if(data2 == "GET DATA")
                    {
                        byte[] msg = Encoding.ASCII.GetBytes(message);
                        handler.Send(msg);
                    }
                    else if(data2 == "ACTION") // command 
                    {
                        string action = datasplt2[1];
                        string[] actionsplt = action.Split('\\');
                        actionlist.Add(actionsplt);
                    }
                    handler.Shutdown(SocketShutdown.Both);
                    handler.Close();
                    listener.Close();
                }
                catch (Exception e)
                {
                    Console.WriteLine(e.Message);
                }
                System.Threading.Thread.Sleep(500);
            }
        }
    }
}
