#!/bin/bash

# epoch age (in seconds) of .setup-complete
SETUP_COMPLETE_AGE=$(stat -f '%c' .setup-complete);
if [[ -f .setup-complete && $(($(date +%s)-SETUP_COMPLETE_AGE)) -lt 30 ]];then
    printf '\e[33mINFO: Performing a restart\e[0m\n'
    make restart

    printf '\e[33mINFO: Done\e[0m\n'
fi
