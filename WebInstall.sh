wget -qO- https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > microsoft.asc.gpg
mv microsoft.asc.gpg /etc/apt/trusted.gpg.d/
wget -q https://packages.microsoft.com/config/debian/9/prod.list
mv prod.list /etc/apt/sources.list.d/microsoft-prod.list
chown root:root /etc/apt/trusted.gpg.d/microsoft.asc.gpg
chown root:root /etc/apt/sources.list.d/microsoft-prod.list

apt install apt-transport-https screen
apt update
apt install dotnet-sdk-2.2

cp -r WebPage/* /var/www/html
dotnet WebServerC/bin/Debug/netcoreapp2.1/WebServerC.dll
