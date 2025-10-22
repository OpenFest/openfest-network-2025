!
version 12.2
no service pad
service timestamps debug datetime msec
service timestamps log datetime msec
service password-encryption
!
hostname sw-reception
!
enable secret @pass@
!
no aaa new-model
system mtu routing 1500
vtp mode transparent
ip subnet-zero
!
!
!
!
no file verify auto
spanning-tree mode pvst
spanning-tree extend system-id
!
vlan internal allocation policy ascending
!
vlan 20
 name of-mgmt
!
vlan 60
 name of-phone
!
vlan 80 
!
vlan 95
 name of-reception
!
interface FastEthernet0/1
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/2
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 20,80
 switchport mode trunk
 spanning-tree portfast trunk
!
interface FastEthernet0/3
 shutdown
!
interface FastEthernet0/4
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/5
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/6
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/7
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/8
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface GigabitEthernet0/1
 description uplink/sw-core
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,80,95,207,999
 switchport mode trunk
 switchport nonegotiate
!
interface Vlan1
 no ip address
!         
interface Vlan20
 ip address 10.20.0.15 255.255.255.0
!
ip default-gateway 10.20.0.1
ip classless
no ip http server
!
logging history informational
logging 10.20.0.1
snmp-server community @pass@ RO
snmp-server enable traps snmp authentication linkdown linkup coldstart warmstart
snmp-server enable traps tty
snmp-server enable traps cluster
snmp-server enable traps entity
snmp-server enable traps cpu threshold
snmp-server enable traps power-ethernet group 1
snmp-server enable traps vtp
snmp-server enable traps vlancreate
snmp-server enable traps vlandelete
snmp-server enable traps flash insertion removal
snmp-server enable traps port-security
snmp-server enable traps envmon fan shutdown supply temperature status
snmp-server enable traps mac-notification
snmp-server enable traps config-copy
snmp-server enable traps config
snmp-server enable traps hsrp
snmp-server enable traps rtr
snmp-server enable traps bridge newroot topologychange
snmp-server enable traps stpx inconsistency root-inconsistency loop-inconsistency
snmp-server enable traps syslog
snmp-server enable traps vlan-membership
snmp-server host 10.20.0.1 @pass@ 
!
control-plane
!
!
line con 0
 password @pass@
 login
line vty 0 4
 password @pass@
 login
line vty 5 15
 login
!         
end

