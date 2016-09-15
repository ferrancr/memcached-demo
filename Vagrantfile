# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty32"
  config.vm.provision "shell", path: "provision/vagrant_boot.sh"
  config.vm.synced_folder "./html/", "/var/www/html", create: true, group: "www-data", owner: "www-data"
  config.vm.define "srv01" do |srv01|
    srv01.vm.network "private_network", ip: "10.1.1.101"
    srv01.vm.provision "shell" do |s|
        s.path = "provision/vagrant_config.sh"
        s.args   = "10.1.1.101"
    end
  end
  config.vm.define "srv02" do |srv02|
    srv02.vm.network "private_network", ip: "10.2.2.102"
    srv02.vm.provision "shell" do |s|
        s.path = "provision/vagrant_config.sh"
        s.args   = "10.2.2.102"
    end
  end
  config.vm.define "srv03" do |srv03|
     srv03.vm.network "private_network", ip: "10.3.3.103"
     srv03.vm.provision "shell" do |s|
        s.path = "provision/vagrant_config.sh"
        s.args   = "10.3.3.103"
     end
  end

end
