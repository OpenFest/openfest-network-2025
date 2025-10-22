!
version 12.2
no service pad
service timestamps debug datetime msec
service timestamps log datetime msec
no service password-encryption
service unsupported-transceiver
!
hostname sw-noc
!
boot-start-marker
boot-end-marker
!
logging buffered 500000
enable secret @pass@
!
!
!
no aaa new-model
switch 1 provision ws-c3750g-48ts
system mtu routing 1500
vtp mode off
!         
!         
!         
!         
!         
!         
!         
!         
!         
spanning-tree mode mst
spanning-tree extend system-id
!         
vlan internal allocation policy ascending
!         
vlan 10   
 name of-ext-techpartk
!         
vlan 20   
 name of-mgmt
!         
vlan 30   
 name of-video-a
!         
vlan 31   
 name of-video-b
!         
vlan 40   
 name of-workshop
!         
vlan 60   
 name of-voip
!         
vlan 70   
 name of-wired
!         
vlan 80   
 name of-wifi
!         
vlan 90   
 name of-overflow
!         
vlan 95   
 name of-rec
lldp run  
!         
!         
!         
interface GigabitEthernet1/0/1
 description Debug-1
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!         
interface GigabitEthernet1/0/2
 description Debug-2
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/3
 description Debug-3
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/4
 description Debug-4
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/5
 description Debug-5
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/6
 description Debug-6
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/7
 description Debug-7
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!         
interface GigabitEthernet1/0/8
 description Debug-8
 switchport access vlan 20
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/9
 description AP-9
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/10
 description AP-10
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/11
 description AP-11
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/12
 description AP-12
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/13
 description AP-13
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/14
 description AP-14
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/15
 description AP-15
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/16
 description AP-16
 switchport access vlan 80
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/17
 description Wired-17
 switchport access vlan 70
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/18
 description Wired-18
 switchport access vlan 70
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/19
 description Wired-19
 switchport access vlan 70
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/20
 description Wired-20
 switchport access vlan 70
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/21
 description VOIP-21
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/22
 description VOIP-22
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/23
 description VOIP-23
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/24
 description VOIP-24
 switchport access vlan 60
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/25
 description overflow-25
 switchport access vlan 90
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/26
 description overflow-26
 switchport access vlan 90
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/27
 description overflow-27
 switchport access vlan 90
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/28
 description overflow-28
 switchport access vlan 90
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/29
 description video-a-29
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/30
 description video-a-30
 switchport access vlan 30
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!         
interface GigabitEthernet1/0/31
 description video-b-31
 switchport access vlan 31
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/32
 description video-b-32
 switchport access vlan 31
 switchport mode access
 switchport nonegotiate
 no lldp transmit
 no cdp enable
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/33
!
interface GigabitEthernet1/0/34
!
interface GigabitEthernet1/0/35
!
interface GigabitEthernet1/0/36
!
interface GigabitEthernet1/0/37
!
interface GigabitEthernet1/0/38
!
interface GigabitEthernet1/0/39
!
interface GigabitEthernet1/0/40
 description rec-40
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/41
 description rec-41
 switchport access vlan 95
 switchport mode access
 switchport nonegotiate
 spanning-tree portfast
 spanning-tree bpdufilter enable
 spanning-tree bpduguard enable
!
interface GigabitEthernet1/0/42
!
interface GigabitEthernet1/0/43
!
interface GigabitEthernet1/0/44
!
interface GigabitEthernet1/0/45
 description downlink/media
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
 no lldp transmit
 no cdp enable
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/46
 description downlink/noc-2
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
 no lldp transmit
 no cdp enable
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/47
 description uplink
 switchport trunk encapsulation dot1q
 switchport mode trunk
!
interface GigabitEthernet1/0/48
 description uplink/fl0
 switchport trunk encapsulation dot1q
 switchport trunk allowed vlan 10,20,30,40,60,70,80,95,207,666,999
 switchport mode trunk
 switchport nonegotiate
 no lldp transmit
 no cdp enable
 spanning-tree portfast trunk
!
interface GigabitEthernet1/0/49
!
interface GigabitEthernet1/0/50
!
interface GigabitEthernet1/0/51
!
interface GigabitEthernet1/0/52
!
interface Vlan1
 no ip address
 shutdown
!
interface Vlan20
 ip address 10.20.0.16 255.255.255.0
!
ip default-gateway 10.20.0.1
ip classless
no ip http server
no ip http secure-server
!
logging history informational
logging 10.20.0.1
snmp-server community @pass@ RO
snmp-server enable traps license
!
vstack
!
line con 0
line vty 0 15
 password @pass@
 login
!
end

