#!/bin/sh

# Function to run the schedule commands every minute
run_schedules() {
  while true
  do
    if [ "$ENABLE_SCHEDULE1" = "true" ]; then
      eval "$SCHEDULE_COMMAND1"
    fi
    sleep $SLEEP_TIME
  done
}

# Start the schedule runner in the background
run_schedules &

# Function to run the queue workers
run_queues() {
  if [ "$ENABLE_QUEUE1" = "true" ]; then
    eval "$QUEUE_COMMAND1" &
  fi
}

# Start the queue workers
run_queues

# Start Apache
apachectl -D FOREGROUND
