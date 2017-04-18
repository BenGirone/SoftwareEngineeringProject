#!/bin/bash
RECIPIENT=$1
USER=$2
CODE=$3
URL=$4
#create a unique file to store the email text
touch $CODE
CONTAINER="$PWD/"$CODE

#insert the email text into the file
echo "To: $RECIPIENT" >> $CONTAINER
echo "From: NoReply.upGrade.App@gmail.com" >> $CONTAINER
echo "Subject: upGrade - Registration Confirmation Code" >> $CONTAINER
echo "" >> $CONTAINER
echo "Hello $USER, Please navigate to the unique URL to reset your account password." >> $CONTAINER
echo "" >> $CONTAINER
echo "Your activation URL is: $URL$CODE" >> $CONTAINER

#send the email from the file
/usr/sbin/ssmtp $RECIPIENT < $CONTAINER

#delete the file
rm $CODE

#confirm that the script ran succesfully
echo "Email sent"
