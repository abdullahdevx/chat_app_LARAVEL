Hello, I've developed this Realtime Chat web application using TALL (TailwindCSS, Alpine.js, LARAVEL, Livewire) stack
Technologies Used:
LARAVEL: back-end developed in LARAVEL 10
LIVEWIRE: front-end is built using Livewire v3
WebSockets (Pusher)
TailwindCSS & Alpine.js

Features:
Built with LARAVEL & LIVEWIRE with session based authentication approach
User can search for Users and then start a chat
refreshes components when user sends a message
Pusher Channels used for realtime communication with LARAVEL events

*** HOW TO RUN THIS PROJECT ON LOCAL HOST ***
Before Running this project
Install and configue XAMPP (run mysql & localhost server)
Install npm via CMD (as administrator)
run php artisan serve
run npm run dev
make sure to change the database creds in .env file
make sure to create a pusher private channel and change the creds in .env file to enable realtime communication
make sure to migrate the database migrations using (php artisan migrate)
THIS WHOLE PROJECT WAS COMPLETELY DEVELOPED BY ME!
THANKS FOR READING
