#!/bin/ash

device='wifi.20'
url='http://10.20.0.1:34925/p.php'

getProvis(){
	curl -s $url -o /dev/null 
	logger -t provis_$mac "first curl exit code $?"
	errorcode=$?
	if [ $errorcode -eq 0 ]; then

		status_code=$(curl -H 'Content-Type: application/json' -d '{"mac":"'$mac'"} ' -o /dev/null -v -w '%{http_code}' $url)
		logger -t provis_$mac "Status code:  $status_code"

		 if [ "$status_code" -eq 200 ]; then
			curl -s -H 'Content-Type: application/json'  -d '{"mac":"'$mac'"}' $url -o /tmp/tmpProv.sh 
			return 0
		else
			logger -t provis_$mac "Non-OK code returned during provisioning: $status_code"
			return 1 
		fi
	else
		logger -t provis_$mac "Error connecting site. Curl error $errorcode "
		return 1
	fi
}

newProvis(){
	logger -t provis_$mac "Check for new Provisioning"
	if [ ! -e "/tmp/oldProv.sh" ]; then 
		touch "/tmp/oldProv.sh"
	fi
	oldMD5=$(md5sum /tmp/oldProv.sh | cut -d ' ' -f1)
	newMD5=$(md5sum /tmp/tmpProv.sh | cut -d ' ' -f1)
	if [ "$oldMD5" != "$newMD5" ]; then
		logger -t provis_$mac "New Provisioning found"
		return 0
	else
		logger -t provis_$mac "No new Provisioning"
		return 1
	fi
}



while true
	do
		mac=$(cat /sys/class/net/$device/address)	
		echo $mac
		logger -t provis_$mac "Start provisioning cicle"
		if getProvis; then
			if newProvis; then
				mv /tmp/tmpProv.sh /tmp/oldProv.sh
				logger -t provis_$mac "Applying new provisioning data."
				source /tmp/oldProv.sh
			else
				logger -t provis_$mac "No new provisioning data."
			fi
		else
			logger -t provis_$mac "Didn't get provosioning data."
		fi
		#sleep 179
		sleep 10
		logger -t provis_$mac "End provisioning cicle. Sleeping ..."
	done

