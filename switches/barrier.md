!TL-SG3210
#
vlan 20,207,372,666,999
#
vlan 20
name "of-mgmt"
#
vlan 207
name "ipact"
#
vlan 372
name "ipacct2025"
#
vlan 666
name "uplink/ipacct ? devhex"
#
#
#
#
hostname "barrier"
#
mac address-table aging-time 300
#
logging buffer 6
no logging file flash                 
#
enable secret @pass@
#
system-time ntp UTC+02:00 10.20.0.1 10.20.0.1 4
#
spanning-tree mode rstp
#
#
user name admin privilege admin password @pass@
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
  switchport access vlan 207
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
#
interface gigabitEthernet 1/0/8
#
interface gigabitEthernet 1/0/9
  switchport mode trunk
  switchport trunk allowed vlan 20,207,372,666,999
  description "downlink/gkc"
  speed 1000
  duplex full
#
interface gigabitEthernet 1/0/10
  switchport access vlan 372
  description "uplink/ipacct"         
  speed 1000
  duplex full
#
ip management-vlan 20
interface vlan 20
ip address 10.20.0.200 255.255.255.0
#
#
line vty 0 15
password openfest25
login
#                                     
end

