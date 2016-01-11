#!/bin/bash

while [ 1 ]; do
	# Grab Viewer count and Timestamp; Save them in respective varaibles
	VWRS="$(curl -s 'https://api.twitch.tv/kraken/streams/summary' | jq '.viewers')"
	TIME="$(date +"%H:%M")"

	# Post this data to our sparkfun data stream
	curl -s -o /dev/null -X POST 'http://data.sparkfun.com/input/NJGqaM0GGbtRrOrd3DOd' \
	-H 'Phant-Private-Key: 5d9g6jK99msWNdNJYBdJ' \
	-d "viewers=$VWRS&time=$TIME"
done
