!
version 12.2
no service pad
service timestamps debug datetime msec
service timestamps log datetime msec
service password-encryption
!
hostname sw-voc-a
!
boot-start-marker
boot-end-marker
!
enable secret @pass@
!
!
!
no aaa new-model
system mtu routing 1500
!
!
vtp mode off
!         
!
spanning-tree mode pvst
spanning-tree extend system-id
!
!
!
!
vlan internal allocation policy ascending
!
vlan 20
 name of-mgmt
!
vlan 30
 name of-video-a
!
vlan 60
 name of-phone
!
lldp run
!
!
interface GigabitEthernet0/1
 description phone-voc-a
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface GigabitEthernet0/2
 description video-0/2
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface GigabitEthernet0/3
 description video-0/3
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface GigabitEthernet0/4
 description video-0/4
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface GigabitEthernet0/5
 description video-0/5
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface GigabitEthernet0/6
 description video-0/6
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!         
interface GigabitEthernet0/7
 description video-0/7
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface GigabitEthernet0/8
 description video-0/8
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
!
interface GigabitEthernet0/9
!
interface GigabitEthernet0/10
 description uplink/sw-core
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,60
 switchport mode trunk
 switchport nonegotiate
!         
interface Vlan1
 no ip address
!
interface Vlan20
 ip address 10.20.0.13 255.255.255.0
!
ip default-gateway 10.20.0.1
ip classless
no ip http server
no ip http secure-server
!
ip sla enable reaction-alerts
logging history informational
logging 10.20.0.1
!
snmp-server community @pass@ RO
snmp-server enable traps snmp authentication linkdown linkup coldstart warmstart
snmp-server enable traps transceiver all
snmp-server enable traps tty
snmp-server enable traps eigrp
snmp-server enable traps ospf state-change
snmp-server enable traps ospf errors
snmp-server enable traps ospf retransmit
snmp-server enable traps ospf lsa
snmp-server enable traps ospf cisco-specific state-change nssa-trans-change
snmp-server enable traps ospf cisco-specific state-change shamlink interface-old
snmp-server enable traps ospf cisco-specific state-change shamlink neighbor
snmp-server enable traps ospf cisco-specific errors
snmp-server enable traps ospf cisco-specific retransmit
snmp-server enable traps ospf cisco-specific lsa
snmp-server enable traps license
snmp-server enable traps auth-framework sec-violation
snmp-server enable traps cef resource-failure peer-state-change peer-fib-state-change inconsistency
snmp-server enable traps cluster
snmp-server enable traps config-copy
snmp-server enable traps config
snmp-server enable traps config-ctid
snmp-server enable traps dot1x auth-fail-vlan guest-vlan no-auth-fail-vlan no-guest-vlan
snmp-server enable traps energywise
snmp-server enable traps fru-ctrl
snmp-server enable traps entity
snmp-server enable traps event-manager
snmp-server enable traps hsrp
snmp-server enable traps ipmulticast
snmp-server enable traps power-ethernet group 1
snmp-server enable traps power-ethernet police
snmp-server enable traps pim neighbor-change rp-mapping-change invalid-pim-message
snmp-server enable traps cpu threshold
snmp-server enable traps rep
snmp-server enable traps rtr
snmp-server enable traps vstack
snmp-server enable traps bridge newroot topologychange
snmp-server enable traps stpx inconsistency root-inconsistency loop-inconsistency
snmp-server enable traps syslog
snmp-server enable traps vtp
snmp-server enable traps vlancreate
snmp-server enable traps vlandelete
snmp-server enable traps flash insertion removal
snmp-server enable traps port-security
snmp-server enable traps envmon fan shutdown supply temperature status
snmp-server enable traps errdisable
snmp-server enable traps mac-notification change move threshold
snmp-server enable traps vlan-membership
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

