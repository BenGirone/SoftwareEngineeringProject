#!/bin/bash
RECIPIENT=$1
USER=$2
CODE=$3
CONTAINER="/var/www/html/xbranch/SoftwareEngineeringProject/shell/container"

echo "To: $RECIPIENT" >> $CONTAINER
echo "From: NoReply.upGrade.App@gmail.com" >> $CONTAINER
echo "Subject: upGrade - Registration Confirmation Code" >> $CONTAINER
echo "" >> $CONTAINER
echo "Hello $USER, Please enter the following numerical code to complete your registration at upGrade" >> $CONTAINER
echo "" >> $CONTAINER
echo "Your Code is: $CODE" >> $CONTAINER
/usr/sbin/ssmtp $RECIPIENT < $CONTAINER

> $CONTAINER

echo "Email sent"
