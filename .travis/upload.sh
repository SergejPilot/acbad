#!/bin/bash
HOST='aero-club.eu'
USER=$1
PASS=$2
TARGETFOLDER='public'
SOURCEFOLDER='public'

lftp -f "
open $HOST
user $USER $PASS
mirror --reverse --delete --verbose $SOURCEFOLDER $TARGETFOLDER
bye
"
