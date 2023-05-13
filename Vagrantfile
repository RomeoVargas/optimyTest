# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|

  if File.exist?('package.box')
    config.vm.box = "optimyProjectBox"
    config.vm.box_url = Dir.pwd + "/package.box"
  else
    config.vm.box = "ubuntu/bionic64"
  end

  config.vm.provider "virtualbox" do |vb|
    vb.name = "optimyProject"
    vb.customize ["modifyvm", :id, "--memory", 9046]
    vb.customize ["modifyvm", :id, "--uartmode1", "disconnected"]
    vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end

  # Create a private network, which allows host-only access to the machine using a specific IP.
  config.vm.network "private_network", ip: "192.168.50.10"

  # Share an additional folder to the guest VM. The first argument is the path on the host to the actual folder.
  # The second argument is the path on the guest to mount the folder.
  config.vm.synced_folder ".", "/vagrant"

  if !File.exist?('package.box')
    # Define the bootstrap file: A (shell) script that runs after first setup of your box (= provisioning)
    config.vm.provision :shell, path: "bootstrap.sh"
  end

end
