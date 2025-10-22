!TL-SG3210
#
vlan 20-28,207,372,666
#
vlan 20
name "of-mgmt"
#
vlan 21
name "of-wired"
#
vlan 22
name "of-wifi"
#
vlan 23
name "of-video"
#
vlan 24
name "of-overflow"
#
vlan 25
name "of-reception"
#
vlan 26
name "of-phone"
#                                     
vlan 27
name "of-workshop"
#
vlan 28
name "wireless2"
#
vlan 207
name "ipact"
#
vlan 372
name "ipacct25"
#
vlan 666
name "uplink/ipacct"
#
#
#
#
hostname "gkc"
contact-info ""
#
mac address-table aging-time 300
#
logging buffer 6                      
no logging file flash
logging host index 1 10.20.0.1 6
#
enable secret @pass@
#
system-time ntp UTC+02:00 10.20.0.1 10.20.0.1 4
#
spanning-tree mode rstp
#
#
user name admin privilege admin secret @pass@
user name root privilege admin secret @pass@
#
#
#
#
#
#
snmp-server
snmp-server community "@pass@" read-only "viewDefault"
#
interface gigabitEthernet 1/0/1
  switchport access vlan 20
#                                     
interface gigabitEthernet 1/0/2
#
interface gigabitEthernet 1/0/3
#
interface gigabitEthernet 1/0/4
#
interface gigabitEthernet 1/0/5
#
interface gigabitEthernet 1/0/6
#
interface gigabitEthernet 1/0/7
  switchport access vlan 23
#
interface gigabitEthernet 1/0/8
  switchport mode trunk
  switchport trunk allowed vlan 20-28
  description "downlink/voc-z"
#
interface gigabitEthernet 1/0/9
  switchport mode trunk
  switchport trunk allowed vlan 20-28,207,372,666
  description "downlink/coresw"
  speed 1000
  duplex full                         
#
interface gigabitEthernet 1/0/10
  switchport mode trunk
  switchport trunk allowed vlan 20-28,207,372,666
  description "uplink/barrier"
  speed 1000
  duplex full
#
ip management-vlan 20
interface vlan 20
ip address 10.20.0.24 255.255.255.0 10.20.0.1
#
#
line vty 0 15
password @pass@
login
#
end

