import React, { useState, useEffect } from 'react';
import { ChevronLeft, ChevronRight, Star, Calendar, Clock, MapPin, Phone, Mail, Facebook, Twitter, Instagram, Youtube, Menu, X } from 'lucide-react';

interface GalleryImage {
  src: string;
  alt: string;
}

interface Testimonial {
  name: string;
  text: string;
  rating: number;
}

const CarWashLanding: React.FC = () => {
  const [selectedDate, setSelectedDate] = useState<number>(21);
  const [currentImageIndex, setCurrentImageIndex] = useState<number>(0);
  const [mobileMenuOpen, setMobileMenuOpen] = useState<boolean>(false);

  const galleryImages: GalleryImage[] = [
    { src: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=500&fit=crop', alt: 'Luxury sports car' },
    { src: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&h=500&fit=crop', alt: 'Car detailing' },
    { src: 'https://images.unsplash.com/photo-1544829542-7e0fb68d2eb1?w=800&h=500&fit=crop', alt: 'Yellow sports car' }
  ];

  const testimonials: Testimonial[] = [
    {
      name: 'Joe Anderson',
      text: 'CarWash is really exceptional, reliable, and provides outstanding car care. I love having my car serviced here.',
      rating: 5
    },
    {
      name: 'Sarah Johnson', 
      text: 'The best car wash service available for years, and their attention to detail is unmatched. My car looks brand new every time.',
      rating: 5
    }
  ];

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentImageIndex((prev) => (prev + 1) % galleryImages.length);
    }, 5000);
    return () => clearInterval(timer);
  }, [galleryImages.length]);

  const nextImage = (): void => {
    setCurrentImageIndex((prev) => (prev + 1) % galleryImages.length);
  };

  const prevImage = (): void => {
    setCurrentImageIndex((prev) => (prev - 1 + galleryImages.length) % galleryImages.length);
  };

  const handleDateSelect = (date: number): void => {
    setSelectedDate(date);
  };

  const toggleMobileMenu = (): void => {
    setMobileMenuOpen(!mobileMenuOpen);
  };

  return (
    <div className="min-h-screen bg-gray-900 text-white">
      {/* Header */}
      <header className="bg-gray-800 shadow-lg">
        <div className="container mx-auto px-4 py-4 flex justify-between items-center">
          <div className="flex items-center space-x-2">
            <div className="w-8 h-8 bg-blue-500 rounded flex items-center justify-center">
              <span className="text-white font-bold text-lg">C</span>
            </div>
            <span className="text-2xl font-bold">CARWAS</span>
          </div>
          
          <nav className="hidden md:flex space-x-8">
            <a href="#home" className="hover:text-blue-400 transition-colors">Home</a>
            <a href="#services" className="hover:text-blue-400 transition-colors">Services</a>
            <a href="#about" className="hover:text-blue-400 transition-colors">About</a>
            <a href="#contact" className="hover:text-blue-400 transition-colors">Contact</a>
          </nav>

          <div className="hidden md:flex space-x-4">
            <button className="px-4 py-2 border border-gray-600 rounded hover:border-blue-400 transition-colors">
              Booking
            </button>
            <button className="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition-colors">
              Login
            </button>
          </div>

          <button 
            className="md:hidden"
            onClick={toggleMobileMenu}
          >
            {mobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <div className="md:hidden bg-gray-700 px-4 py-4 space-y-4">
            <a href="#home" className="block hover:text-blue-400">Home</a>
            <a href="#services" className="block hover:text-blue-400">Services</a>
            <a href="#about" className="block hover:text-blue-400">About</a>
            <a href="#contact" className="block hover:text-blue-400">Contact</a>
            <div className="flex space-x-4 pt-4">
              <button className="px-4 py-2 border border-gray-600 rounded">Booking</button>
              <button className="px-4 py-2 bg-blue-600 rounded">Login</button>
            </div>
          </div>
        )}
      </header>

      {/* Hero Section */}
      <section id="home" className="relative h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
        <div className="absolute inset-0 bg-black bg-opacity-50"></div>
        <div 
          className="absolute inset-0 bg-cover bg-center transition-all duration-1000"
          style={{
            backgroundImage: `url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1920&h=1080&fit=crop')`
          }}
        ></div>
        
        <div className="relative z-10 container mx-auto px-4 h-full flex items-center">
          <div className="max-w-2xl">
            <h1 className="text-5xl md:text-7xl font-bold mb-6 leading-tight">
              CarWash Where Your Car's Shine Takes Flight
            </h1>
            <p className="text-xl mb-8 text-gray-300">
              Book Car Car wash with the Best Largest car wash specialists starting from just 29K.
            </p>
            <button className="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 transform hover:scale-105">
              Book Now
            </button>
          </div>
          
          <div className="hidden lg:block absolute right-20 top-1/2 transform -translate-y-1/2">
            <div className="w-64 h-64 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
              <img 
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face" 
                alt="Professional" 
                className="w-48 h-48 rounded-full object-cover"
              />
            </div>
          </div>
        </div>
      </section>

      {/* About Section */}
      <section className="py-20 bg-gray-800">
        <div className="container mx-auto px-4">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            <div>
              <h2 className="text-4xl font-bold mb-6">Clean and Hygiene With Jet Wash The Cleaning Company</h2>
              <p className="text-gray-300 mb-8 leading-relaxed">
                We provide professional car wash services with state-of-the-art equipment and eco-friendly products. 
                Our experienced team ensures your vehicle gets the care it deserves.
              </p>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-gray-700 p-6 rounded-lg text-center hover:bg-gray-600 transition-colors">
                  <div className="w-12 h-12 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span className="text-white font-bold">NT</span>
                  </div>
                  <h3 className="font-semibold mb-2">New Technology</h3>
                  <p className="text-sm text-gray-300">Latest equipment</p>
                </div>
                
                <div className="bg-gray-700 p-6 rounded-lg text-center hover:bg-gray-600 transition-colors">
                  <div className="w-12 h-12 bg-green-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span className="text-white font-bold">FS</span>
                  </div>
                  <h3 className="font-semibold mb-2">Fast Service</h3>
                  <p className="text-sm text-gray-300">Quick turnaround</p>
                </div>
                
                <div className="bg-gray-700 p-6 rounded-lg text-center hover:bg-gray-600 transition-colors">
                  <div className="w-12 h-12 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span className="text-white font-bold">TS</span>
                  </div>
                  <h3 className="font-semibold mb-2">Top Service</h3>
                  <p className="text-sm text-gray-300">Premium quality</p>
                </div>
              </div>
            </div>
            
            <div className="relative">
              <img 
                src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop" 
                alt="Car washing" 
                className="rounded-lg shadow-2xl"
              />
              <div className="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center">
                <span className="text-2xl font-bold">C</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section id="services" className="py-20 bg-gray-900">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold mb-4">All-in-One Cleaning Solutions CarWash</h2>
            <p className="text-gray-300 max-w-2xl mx-auto">
              Choose from our comprehensive range of car wash packages designed to meet every need and budget.
            </p>
          </div>
          
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div className="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
              <img 
                src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=250&fit=crop" 
                alt="Basic wash" 
                className="w-full h-48 object-cover"
              />
              <div className="p-6">
                <h3 className="text-xl font-bold mb-2">Packet 1 (99K/1 Jam)</h3>
                <p className="text-gray-300 text-sm mb-4">Basic exterior wash and dry</p>
                <div className="text-2xl font-bold text-blue-400">99K</div>
              </div>
            </div>
            
            <div className="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
              <img 
                src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400&h=250&fit=crop" 
                alt="Premium wash" 
                className="w-full h-48 object-cover"
              />
              <div className="p-6">
                <h3 className="text-xl font-bold mb-2">Packet 2 (149K/2 Jam)</h3>
                <p className="text-gray-300 text-sm mb-4">Complete wash with wax</p>
                <div className="text-2xl font-bold text-blue-400">149K</div>
              </div>
            </div>
            
            <div className="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
              <img 
                src="https://images.unsplash.com/photo-1544829542-7e0fb68d2eb1?w=400&h=250&fit=crop" 
                alt="Deluxe wash" 
                className="w-full h-48 object-cover"
              />
              <div className="p-6">
                <h3 className="text-xl font-bold mb-2">Packet 3 (179K/3 Jam)</h3>
                <p className="text-gray-300 text-sm mb-4">Interior and exterior detail</p>
                <div className="text-2xl font-bold text-blue-400">179K</div>
              </div>
            </div>
            
            <div className="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 md:col-span-2 lg:col-span-1">
              <img 
                src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=250&fit=crop" 
                alt="Complete package" 
                className="w-full h-48 object-cover"
              />
              <div className="p-6">
                <h3 className="text-xl font-bold mb-2">Complete Packet (499K/5 Jam)</h3>
                <p className="text-gray-300 text-sm mb-4">Full detailing service</p>
                <div className="text-2xl font-bold text-blue-400">499K</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Booking Section */}
      <section className="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold mb-4">Book in 3 Easy Steps</h2>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8 mb-16">
            <div className="text-center">
              <div className="w-16 h-16 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                <span className="text-2xl font-bold">1</span>
              </div>
              <h3 className="text-xl font-bold mb-4">Choose a Service</h3>
              <p className="text-gray-300">Select the perfect car wash package that fits your needs and budget.</p>
            </div>
            
            <div className="text-center">
              <div className="w-16 h-16 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                <Clock size={24} />
              </div>
              <h3 className="text-xl font-bold mb-4">Choose Date</h3>
              <p className="text-gray-300">Pick your preferred date and time slot for maximum convenience.</p>
            </div>
            
            <div className="text-center">
              <div className="w-16 h-16 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                <Calendar size={24} />
              </div>
              <h3 className="text-xl font-bold mb-4">Get Cleaning</h3>
              <p className="text-gray-300">Sit back and relax while our professionals take care of your vehicle.</p>
            </div>
          </div>
          
          {/* Calendar Widget */}
          <div className="max-w-md mx-auto bg-white rounded-lg shadow-2xl overflow-hidden">
            <div className="bg-gray-100 px-6 py-4 text-center">
              <h3 className="text-lg font-bold text-gray-800">April 2024</h3>
            </div>
            <div className="p-6">
              <div className="grid grid-cols-7 gap-2 text-center text-gray-800">
                {['S', 'M', 'T', 'W', 'T', 'F', 'S'].map((day) => (
                  <div key={day} className="p-2 font-semibold">{day}</div>
                ))}
                {Array.from({ length: 30 }, (_, i) => i + 1).map((date) => (
                  <button
                    key={date}
                    onClick={() => handleDateSelect(date)}
                    className={`p-2 rounded ${
                      selectedDate === date 
                        ? 'bg-blue-500 text-white' 
                        : 'hover:bg-gray-100'
                    }`}
                  >
                    {date}
                  </button>
                ))}
              </div>
            </div>
          </div>
          
          <div className="text-center mt-8">
            <button className="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 transform hover:scale-105">
              Book Schedule
            </button>
          </div>
        </div>
      </section>

      {/* Testimonials Section */}
      <section className="py-20 bg-gray-800">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div>
              <div className="bg-blue-500 rounded-lg p-8 shadow-2xl">
                <img 
                  src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop&crop=face" 
                  alt="Map" 
                  className="w-full h-64 object-cover rounded"
                />
              </div>
            </div>
            
            <div>
              <h2 className="text-4xl font-bold mb-8">What Our Clients Say</h2>
              
              {testimonials.map((testimonial, index) => (
                <div key={index} className="mb-8 bg-gray-700 p-6 rounded-lg">
                  <div className="flex mb-4">
                    {[...Array(testimonial.rating)].map((_, i) => (
                      <Star key={i} className="w-5 h-5 text-yellow-400 fill-current" />
                    ))}
                  </div>
                  <p className="text-gray-300 mb-4 italic">"{testimonial.text}"</p>
                  <p className="font-semibold text-blue-400">- {testimonial.name}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Gallery Section */}
      <section className="py-20 bg-gray-900">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold mb-4">Gallery</h2>
            <p className="text-gray-300">See our work in action</p>
          </div>
          
          <div className="relative max-w-4xl mx-auto">
            <div className="relative h-96 rounded-lg overflow-hidden">
              <img 
                src={galleryImages[currentImageIndex].src}
                alt={galleryImages[currentImageIndex].alt}
                className="w-full h-full object-cover transition-all duration-500"
              />
              
              <button 
                onClick={prevImage}
                className="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 p-2 rounded-full transition-all"
              >
                <ChevronLeft size={24} />
              </button>
              
              <button 
                onClick={nextImage}
                className="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 p-2 rounded-full transition-all"
              >
                <ChevronRight size={24} />
              </button>
            </div>
            
            <div className="flex justify-center mt-6 space-x-2">
              {galleryImages.map((_, index) => (
                <button
                  key={index}
                  onClick={() => setCurrentImageIndex(index)}
                  className={`w-3 h-3 rounded-full transition-all ${
                    currentImageIndex === index ? 'bg-blue-500' : 'bg-gray-600'
                  }`}
                />
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer id="contact" className="bg-gray-800 py-16">
        <div className="container mx-auto px-4">
          <div className="grid md:grid-cols-2 gap-12">
            <div>
              <div className="flex items-center space-x-2 mb-6">
                <div className="w-8 h-8 bg-blue-500 rounded flex items-center justify-center">
                  <span className="text-white font-bold text-lg">C</span>
                </div>
                <span className="text-2xl font-bold">CARWAS</span>
              </div>
              
              <div className="space-y-4 mb-8">
                <div className="flex items-center space-x-3">
                  <MapPin className="text-blue-400" size={20} />
                  <span>Sari Segara Desa, Kuta, Badung Regency, Bali 80361</span>
                </div>
                <div className="flex items-center space-x-3">
                  <Phone className="text-blue-400" size={20} />
                  <span>+1 234 567 890</span>
                </div>
                <div className="flex items-center space-x-3">
                  <Mail className="text-blue-400" size={20} />
                  <span>info@carwas.com</span>
                </div>
              </div>
              
              <div className="flex space-x-4">
                <Facebook className="text-blue-400 hover:text-blue-300 cursor-pointer" size={24} />
                <Twitter className="text-blue-400 hover:text-blue-300 cursor-pointer" size={24} />
                <Instagram className="text-blue-400 hover:text-blue-300 cursor-pointer" size={24} />
                <Youtube className="text-blue-400 hover:text-blue-300 cursor-pointer" size={24} />
              </div>
            </div>
            
            <div>
              <h3 className="text-xl font-bold mb-6">Join Our Newsletter</h3>
              <p className="text-gray-300 mb-6">
                Keep up to date with the latest updates, trends, services, and offers from CarWas.
              </p>
              
              <div className="flex space-x-4">
                <input 
                  type="email" 
                  placeholder="Your email address"
                  className="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-400"
                />
                <button className="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold transition-colors">
                  Subscribe
                </button>
              </div>
            </div>
          </div>
          
          <div className="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; Copyright 2025 CarWas. All Rights Reserved.</p>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default CarWashLanding;