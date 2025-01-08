#!/bin/sh

# Function to run the schedule commands every minute
run_schedules() {
  while true
  do
    if [ "$ENABLE_SCHEDULE1" = "true" ]; then
      eval "$SCHEDULE_COMMAND1"
    fi
    if [ "$ENABLE_SCHEDULE2" = "true" ]; then
      eval "$SCHEDULE_COMMAND2"
    fi
    if [ "$ENABLE_SCHEDULE3" = "true" ]; then
      eval "$SCHEDULE_COMMAND3"
    fi
    if [ "$ENABLE_SCHEDULE4" = "true" ]; then
      eval "$SCHEDULE_COMMAND4"
    fi
    if [ "$ENABLE_SCHEDULE5" = "true" ]; then
      eval "$SCHEDULE_COMMAND5"
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
  if [ "$ENABLE_QUEUE2" = "true" ]; then
    eval "$QUEUE_COMMAND2" &
  fi
  if [ "$ENABLE_QUEUE3" = "true" ]; then
    eval "$QUEUE_COMMAND3" &
  fi
  if [ "$ENABLE_QUEUE4" = "true" ]; then
    eval "$QUEUE_COMMAND4" &
  fi
  if [ "$ENABLE_QUEUE5" = "true" ]; then
    eval "$QUEUE_COMMAND5" &
  fi
}

# Start the queue workers
run_queues

# Start Apache
apachectl -D FOREGROUND
