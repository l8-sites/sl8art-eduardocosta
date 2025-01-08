#!/bin/sh

# Function to run the schedule command every minute
run_schedule() {
  while true
  do
    php /app/artisan schedule:run
    sleep 60
  done
}

# Start the schedule runner in the background
run_schedule &

# Start the queue worker
php /app/artisan queue:work &

# Start Apache
apachectl -D FOREGROUND
