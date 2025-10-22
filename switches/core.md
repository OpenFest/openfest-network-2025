!
version 12.2
no service pad
service timestamps debug uptime
service timestamps log datetime msec
no service password-encryption
service internal
service sequence-numbers
service unsupported-transceiver
!
hostname core-sw
!
boot-start-marker
boot-end-marker
!
logging buffered 500000
enable secret @pass@
!
!
no aaa new-model
switch 1 provision ws-c3750e-48pd
system mtu routing 1500
ip routing
!
!
no ip domain-lookup
ip name-server 10.20.0.2
ip name-server 10.20.0.1
vtp mode off
!
!
spanning-tree mode mst
spanning-tree extend system-id
spanning-tree mst 0 priority 4096
no spanning-tree vlan 666,999
spanning-tree vlan 1,10,20-27 priority 0
!
!
!
no errdisable detect cause gbic-invalid
no errdisable detect cause sfp-config-mismatch
!
vlan internal allocation policy ascending
!
vlan 10
 name of-ext
!
vlan 20
 name of-mgmt
!
vlan 21
 name of-wired
!
vlan 22
 name of-wifi
!
vlan 23
 name of-video
!         
vlan 24
 name of-overflow
!
vlan 25
 name of-reception
!
vlan 26
 name of-phone
!
vlan 27
 name of-workshop
!
vlan 30
 name of-video-a
!
vlan 31
 name of-video-b
!
vlan 40
 name of-workshop-a
!
vlan 50
 name of-reception-a
!
vlan 60
 name of-voip
!
vlan 70
 name of-wired-a
!
vlan 80
 name of-wifi-a
!
vlan 90
 name of-overflow-a
!
vlan 95
 name of-pos
!
vlan 207
 name ipacct207
!
vlan 372
 name ipacct25
!
vlan 666  
 name devhex-uplink
!
vlan 999
 name ipacct
!
lldp run
!
!
!
interface FastEthernet0
 no ip address
 no ip route-cache cef
 no ip route-cache
 no ip mroute-cache
!
interface GigabitEthernet1/0/1
 description Debug
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/2
 description Debug
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/3
 switchport access vlan 666
 switchport mode access
 switchport nonegotiate
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/4
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/5
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/6
 switchport access vlan 70
 switchport mode access
 switchport nonegotiate
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/7
 switchport access vlan 70
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!         
interface GigabitEthernet1/0/8
!
interface GigabitEthernet1/0/9
 description beer-machine
 switchport access vlan 80
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/10
 description switch
 switchport access vlan 70
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode access
 switchport nonegotiate
!
interface GigabitEthernet1/0/11
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/12
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/13
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/14
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/15
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/16
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/17
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,31,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/18
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/19
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/20
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/21
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/22
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/23
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/24
 description switch
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/25
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/26
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/27
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/28
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,31,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/29
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/30
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!         
interface GigabitEthernet1/0/31
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/32
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/33
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/34
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/35
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/36
 description AP
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,90,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/37
!
interface GigabitEthernet1/0/38
!         
interface GigabitEthernet1/0/39
!
interface GigabitEthernet1/0/40
!
interface GigabitEthernet1/0/41
!
interface GigabitEthernet1/0/42
!
interface GigabitEthernet1/0/43
 switchport access vlan 10
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/44
 switchport access vlan 10
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/45
 description server mirror
 switchport access vlan 22
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20-27,999
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/46
 description server
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 666
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/47
 description uplink-A1
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20-28,207,372,666,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/48
 description server
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20-28,207,372,666,999
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/49
!
interface GigabitEthernet1/0/50
!
interface GigabitEthernet1/0/51
 description floor0-sw
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 20-28,30,40,50,60,70,80,90,95,207,999
 switchport mode trunk
 switchport nonegotiate
!
interface GigabitEthernet1/0/52
 description uplink-gkc
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20-28,207,372,666,999
 switchport mode trunk
 switchport nonegotiate
 no cdp enable
 no lldp transmit
 spanning-tree portfast trunk
!
interface TenGigabitEthernet1/0/1
 description server
 switchport trunk encapsulation dot1q
 switchport mode trunk
 switchport nonegotiate
 spanning-tree portfast trunk
!
interface TenGigabitEthernet1/0/2
!
interface Vlan1
 no ip address
!
interface Vlan20
 ip address 10.20.0.10 255.255.255.0
!
interface Vlan666
 ip address 10.10.10.3 255.255.255.0
!
ip default-gateway 10.20.0.1
ip classless
!
no ip http server
no ip http secure-server
!
logging history informational
logging 10.20.0.1
!
snmp-server community @pass@ RO
snmp-server enable traps license
!
!
line con 0
line vty 0 15
 password @pass@
 login
!
end

