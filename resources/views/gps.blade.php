<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>GPS Tracker</title>
  <script>
    // Function to send GPS coordinates to the server
    async function sendLocation(latitude, longitude) {
      try {
        // Send the GPS data to the server
        const response = await fetch('/gps', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
          },
          body: JSON.stringify({ latitude, longitude })
        });

        const data = await response.json();
        console.log('Location sent:', data);
      } catch (error) {
        console.error('Error sending location:', error);
      }
    }

    // Function to update the displayed coordinates on the page
    function updateDisplayedLocation(latitude, longitude) {
      document.getElementById('latitude').textContent = latitude;
      document.getElementById('longitude').textContent = longitude;
    }

    // Function to get the user's current position
    function getLocationAndSend() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
          const { latitude, longitude } = position.coords;

          // Update the displayed coordinates
          updateDisplayedLocation(latitude, longitude);

          // Send the location to the server
          sendLocation(latitude, longitude);
        }, (error) => {
          console.error('Error getting location:', error);
        });
      } else {
        console.error('Geolocation is not supported by this browser.');
      }
    }

    // Run the function every 20 seconds
    setInterval(getLocationAndSend, 20000);

    // Get and send location immediately when the page loads
    window.onload = getLocationAndSend;
  </script>

  <!-- Tailwind CSS styles or CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative px-6 bg-white isolate pt-14 lg:px-8">
  <!-- Gradient background -->
  <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80" aria-hidden="true">
    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
  </div>

  <div class="max-w-2xl py-32 mx-auto text-center sm:py-48 lg:py-56">
    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">GPS Tracking App</h1>
    <p class="mt-6 text-lg leading-8 text-gray-600">Your location is being tracked and updated every 20 seconds.</p>

    <!-- Display the coordinates dynamically -->
    <div class="relative px-3 py-5 mt-6 text-sm leading-6 text-gray-600 rounded-full ring-1 ring-gray-900/10 hover:ring-gray-900/20">
    <p><strong>Latitude:</strong> <span id="latitude">Loading...</span></p>
    <p><strong>Longitude:</strong> <span id="longitude">Loading...</span></p>
    </div>
  </div>

  <!-- Bottom gradient -->
  <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
  </div>
</body>
</html>
