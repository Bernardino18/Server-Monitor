using System;
using System.Threading;
using System.Net;
using System.Net.Sockets;
using System.Text;
using System.Collections.Generic;

namespace WebServerC
{
    class Program
    {
        static List<string> IPList = new List<string>();
        static void Main(string[] args)
        {
            Console.Write("Enter Bind IP: ");
            string ip = Console.ReadLine();
            Thread childthread = new Thread(() => StartServer(ip));
            childthread.Start();
            Thread childthread2 = new Thread(() => StartClient(ip));
            childthread2.Start();
            while (true)
            {
                foreach(string str in IPList)
                {
                    Console.WriteLine(str);
                }
                Thread.Sleep(500);
                Console.Clear();
            }
        }
        public static void StartServer(string ip)
        {
            IPAddress ipAddress = IPAddress.Parse(ip);
            IPEndPoint localEndPoint = new IPEndPoint(ipAddress, 11100);
            while (true)
            {
                try
                {
                    Socket listener = new Socket(ipAddress.AddressFamily, SocketType.Stream, ProtocolType.Tcp);
                    listener.Bind(localEndPoint);
                    listener.Listen(10);
                    Socket handler = listener.Accept();
                    string data = null;
                    byte[] bytes = null;
                    bytes = new byte[1024];
                    int bytesRec = handler.Receive(bytes);
                    data += Encoding.ASCII.GetString(bytes, 0, bytesRec);
                    string[] datasplt = data.Split("\\");
                    if (!IPList.Contains(datasplt[1]+"\\"+datasplt[2]) && datasplt[0]=="ON")
                    {
                        IPList.Add(datasplt[1] + "\\" + datasplt[2]);
                    }
                    else if(IPList.Contains(datasplt[1] + "\\" + datasplt[2]) && datasplt[0]=="OFF")
                    {
                        IPList.Remove(datasplt[1] + "\\" + datasplt[2]);
                    }
                    handler.Shutdown(SocketShutdown.Both);
                    handler.Close();
                    listener.Close();
                }
                catch (Exception e)
                {
                    Console.WriteLine(e.ToString());
                }
                Thread.Sleep(500);
            }
        }
        public static void StartClient(string ip)
        {
            IPAddress ipAddress = IPAddress.Parse("127.0.0.1");
            IPEndPoint localEndPoint = new IPEndPoint(ipAddress, 12300);
            while (true)
            {
                try
                {
                    Socket listener = new Socket(ipAddress.AddressFamily, SocketType.Stream, ProtocolType.Tcp);
                    listener.Bind(localEndPoint);
                    listener.Listen(10);
                    Socket handler = listener.Accept();
                    string data = "";
                    foreach (string str in IPList)
                    {
                        data += str + ":";
                    }
                    byte[] msg = Encoding.ASCII.GetBytes(data);
                    handler.Send(msg);
                    handler.Shutdown(SocketShutdown.Both);
                    handler.Close();
                    listener.Close();
                }
                catch (Exception e)
                {
                    Console.WriteLine(e.ToString());
                }
                Thread.Sleep(500);
            }
        }
    }
}
