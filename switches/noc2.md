!
version 12.2
no service pad
service timestamps debug datetime msec
service timestamps log datetime msec
service password-encryption
!
hostname sw-noc-2
!
boot-start-marker
boot-end-marker
!
enable password @pass@
!
no aaa new-model
system mtu routing 1500
vtp mode transparent
ip subnet-zero
!
!
!
!         
!
!
!
!
spanning-tree mode pvst
spanning-tree extend system-id
!
vlan internal allocation policy ascending
!
vlan 20
 name of-mgmt
!
vlan 30
 name of-video
!
vlan 60
 name of-phone
!
vlan 70
 name of-wired
!
vlan 80
 name of-wifi
!
vlan 95
 name of-reception
lldp run
!
!
!
interface FastEthernet0/1
 description noc2-phone-1
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/2
 description noc2-phone-2
 switchport access vlan 60
 switchport trunk encapsulation dot1q
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/3
 description noc2-phone-3
 switchport access vlan 80
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,95,207,999
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/4
 description noc2-phone-4
 switchport access vlan 80
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,95,207,999
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/5
 description mgmt-5
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,95,207,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/6
 description mgmt-6
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,95,207,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/7
 description wired-7
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,95,207,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/8
 description wired-8
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,95,207,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/9
 description wifi-9
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,80,95,207,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/10
 description wifi-10
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,50,60,70,80,95,207,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface FastEthernet0/11
 description rec-12
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface FastEthernet0/12
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
 ip address 10.20.0.17 255.255.255.0
!
ip default-gateway 10.20.0.1
ip classless
no ip http server
!
logging history informational
logging 10.20.0.1
snmp-server community @pass@ RO
snmp-server enable traps snmp authentication linkdown linkup coldstart warmstart
snmp-server enable traps transceiver all
snmp-server enable traps tty
snmp-server enable traps eigrp
snmp-server enable traps cluster
snmp-server enable traps entity
snmp-server enable traps cpu threshold
snmp-server enable traps power-ethernet group 1
snmp-server enable traps power-ethernet police
snmp-server enable traps rep
snmp-server enable traps vtp
snmp-server enable traps vlancreate
snmp-server enable traps vlandelete
snmp-server enable traps flash insertion removal
snmp-server enable traps port-security
snmp-server enable traps dot1x auth-fail-vlan guest-vlan no-auth-fail-vlan no-guest-vlan
snmp-server enable traps envmon fan shutdown supply temperature status
snmp-server enable traps cef resource-failure peer-state-change peer-fib-state-change inconsistency
snmp-server enable traps config-copy
snmp-server enable traps config
snmp-server enable traps config-ctid
snmp-server enable traps hsrp
snmp-server enable traps bridge newroot topologychange
snmp-server enable traps stpx inconsistency root-inconsistency loop-inconsistency
snmp-server enable traps syslog
snmp-server enable traps mac-notification change move threshold
snmp-server enable traps vlan-membership
snmp-server enable traps errdisable
snmp-server host 10.20.0.1 @pass@ 
!
control-plane
!
!
line con 0
 password @pass@
line vty 0 15
 password @pass@
 login
!         
end

