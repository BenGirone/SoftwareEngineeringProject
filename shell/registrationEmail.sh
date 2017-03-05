#!/bin/bash
RECIPIENT=$1
USER=$2
CODE=$3

touch $CODE
CONTAINER="$PWD/"$CODE

echo "To: $RECIPIENT" >> $CONTAINER
echo "From: NoReply.upGrade.App@gmail.com" >> $CONTAINER
echo "Subject: upGrade - Registration Confirmation Code" >> $CONTAINER
echo "" >> $CONTAINER
echo "Hello $USER, Please enter the following numerical code to complete your registration at upGrade" >> $CONTAINER
echo "" >> $CONTAINER
echo "Your Code is: $CODE" >> $CONTAINER
/usr/sbin/ssmtp $RECIPIENT < $CONTAINER

rm $CODE

echo "Email sent"
