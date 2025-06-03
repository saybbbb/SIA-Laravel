<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>24H AAWS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<style>
  html {
    scroll-behavior: smooth;
  }
  body {
    font-family: 'Poppins', sans-serif;
  }
  .feature-card {
    background: white;
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }
  .feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  }
</style>
</head>
<body class="flex flex-col min-h-screen">

  <!-- Header -->
<header class="flex items-center justify-between px-12 py-8">
  <div class="flex items-center space-x-4">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-14">
    <span class="font-bold text-2xl text-blue-700">Automatic Alternating Water System (AAWS)</span>
  </div>
  <nav class="space-x-8 text-lg">
    <a href="#home" class="text-blue-600 font-semibold hover:underline">Home</a>
    <a href="#about" class="text-blue-600 font-semibold hover:underline">About</a>
    <a href="#contact" class="text-blue-600 font-semibold hover:underline">Contact</a>
  </nav>
</header>

  <!-- Hero Section -->
<main id="home" class="flex-grow flex flex-col items-center justify-center text-center px-8 py-32 bg-cover bg-center relative" style="background-image: url('{{ asset('images/image.png') }}');">
  <div class="bg-white bg-opacity-80 p-20 rounded-3xl shadow-2xl max-w-4xl w-full">
    <h1 class="text-6xl font-bold text-blue-800 mb-8">Efficient. Reliable. Automated.</h1>
    <p class="text-gray-700 max-w-2xl mx-auto mb-10 text-2xl">AAWS provides advanced solutions to maintain uninterrupted water supply, tailored specifically for commercial and industrial environments.</p>
    <div class="flex justify-center space-x-8">
      <a href="/login" class="px-8 py-4 border border-blue-600 text-blue-600 text-xl font-semibold rounded-full shadow hover:bg-blue-600 hover:text-white transition duration-300">
        Login
      </a>
      <a href="/register" class="px-8 py-4 border border-green-600 text-green-600 text-xl font-semibold rounded-full shadow hover:bg-green-600 hover:text-white transition duration-300">
        Register
      </a>
    </div>
  </div>
</main>

<!-- Features Section -->
<section id="features" class="bg-gray-50 py-32 px-8">
  <div class="max-w-7xl mx-auto">
    <div class="grid md:grid-cols-2 gap-16 mb-20">
      <div class="feature-card">
        <h3 class="text-3xl font-bold text-blue-700 mb-8 flex items-center">
          <i class="fas fa-bolt text-yellow-500 mr-4"></i> Energy Issues
        </h3>
        <div class="flex items-center mb-6 text-xl">
          <span class="font-medium mr-2">Energy Coverage</span>
          <i class="fas fa-arrow-right text-blue-500 mx-2"></i>
          <span class="font-semibold text-blue-600">System</span>
        </div>
        <p class="text-gray-600 text-xl">
          Our advanced monitoring ensures optimal energy usage throughout the water distribution process.
        </p>
      </div>

      <div class="feature-card">
        <h3 class="text-3xl font-bold text-blue-700 mb-8">AAWS</h3>
        <p class="text-gray-600 mb-4 text-xl">Automatic Alternating Water System</p>
        <p class="text-gray-600 text-xl">
          The most reliable solution for uninterrupted water supply in commercial and industrial applications.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="bg-white py-32 px-8">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-blue-800 mb-20">Key Features:</h2>

    <div class="grid md:grid-cols-3 gap-16">
      <div class="feature-card">
        <div class="text-blue-600 mb-6 text-5xl">
          <i class="fas fa-clock"></i>
        </div>
        <h3 class="text-3xl font-bold text-blue-800 mb-6">24/7 Continuous Operation</h3>
        <p class="text-gray-600 text-xl">
          Reliable and uninterrupted water distribution for your business operations.
        </p>
      </div>

      <div class="feature-card">
        <div class="text-blue-600 mb-6 text-5xl">
          <i class="fas fa-leaf"></i>
        </div>
        <h3 class="text-3xl font-bold text-blue-800 mb-6">Energy Efficient Technology</h3>
        <p class="text-gray-600 text-xl">
          Advanced monitoring ensures optimized energy usage and significant cost savings.
        </p>
      </div>

      <div class="feature-card">
        <div class="text-blue-600 mb-6 text-5xl">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="text-3xl font-bold text-blue-800 mb-6">Dependable and Low Maintenance</h3>
        <p class="text-gray-600 text-xl">
          Built on proven technology, minimizing downtime and maintenance requirements.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer id="contact" class="bg-gray-200 text-center py-6 mt-auto">
  <p class="text-gray-600 text-base mb-2">© 2025 Automatic Alternating Water Systems. All Rights Reserved.</p>
  <p class="text-gray-600 text-base">Cyber Storm Montejo © Charlie Omongos</p>
</footer>

<!-- Go Up Button -->
<a href="#home" class="fixed bottom-8 right-8 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
  <i class="fas fa-arrow-up"></i>
</a>


</body>
</html>
