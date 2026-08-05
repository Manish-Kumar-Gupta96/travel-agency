// Centralized Mock Database matching Laravel Eloquent models

// 1. Destinations (Model: Destination)
export const mockDestinations = [
    {
        id: 1,
        name: "Bali",
        country: "Indonesia",
        state: "Bali Province",
        city: "Denpasar",
        description: "Bali is a popular tourist destination, which is known for its highly developed arts, including traditional and modern dance, sculpture, painting, leather, metalworking, and music.",
        short_description: "Tropical paradise with rich culture and beaches",
        featured_image: "https://images.unsplash.com/photo-1537996194471-e657df975ab4",
        banner_image: "https://images.unsplash.com/photo-1537996194471-e657df975ab4",
        best_time: "April to October",
        currency: "IDR",
        language: "Indonesian, Balinese",
        timezone: "GMT+8",
        featured: 1,
        status: "active"
    },
    {
        id: 2,
        name: "Swiss Alps",
        country: "Switzerland",
        state: "Bernese Oberland",
        city: "Interlaken",
        description: "The Swiss Alps are a defining natural feature of Switzerland, offering soaring snow-capped peaks, deep valleys, pristine glaciers, and crystalline lakes.",
        short_description: "Majestic mountains and alpine meadows",
        featured_image: "https://images.unsplash.com/photo-1506744038136-46273834b3fb",
        banner_image: "https://images.unsplash.com/photo-1506744038136-46273834b3fb",
        best_time: "December to April (Skiing), June to October (Hiking)",
        currency: "CHF",
        language: "German, French, Italian",
        timezone: "GMT+1",
        featured: 1,
        status: "active"
    },
    {
        id: 3,
        name: "Tokyo",
        country: "Japan",
        state: "Kanto",
        city: "Tokyo",
        description: "Tokyo is Japan's bustling capital, mixing ultra-modern skyscrapers with historic temples, cherry blossoms, and world-class culinary experiences.",
        short_description: "Neon lights, modern technology, and heritage",
        featured_image: "https://images.unsplash.com/photo-1503899036084-c55cdd92da26",
        banner_image: "https://images.unsplash.com/photo-1503899036084-c55cdd92da26",
        best_time: "March to May (Cherry Blossom), September to November",
        currency: "JPY",
        language: "Japanese",
        timezone: "GMT+9",
        featured: 1,
        status: "active"
    },
    {
        id: 4,
        name: "Rajasthan",
        country: "India",
        state: "Rajasthan",
        city: "Jaipur",
        description: "Rajasthan is India's largest state by area, famous for its grand palaces, rugged forts, Thar Desert dunes, and vibrant heritage.",
        short_description: "Land of kings, historic forts, and palaces",
        featured_image: "https://images.unsplash.com/photo-1477587458883-471a5ed08bc4",
        banner_image: "https://images.unsplash.com/photo-1477587458883-471a5ed08bc4",
        best_time: "October to March",
        currency: "INR",
        language: "Hindi, Rajasthani",
        timezone: "GMT+5:30",
        featured: 0,
        status: "active"
    },
    {
        id: 5,
        name: "Maldives",
        country: "Maldives",
        state: "Male Atoll",
        city: "Male",
        description: "Maldives is a tropical nation in the Indian Ocean composed of 26 ring-shaped atolls, which are made up of more than 1,000 coral islands, renowned for beach resorts and lagoons.",
        short_description: "Overwater bungalows and turquoise lagoons",
        featured_image: "https://images.unsplash.com/photo-1439066615861-d1af74d74000",
        banner_image: "https://images.unsplash.com/photo-1439066615861-d1af74d74000",
        best_time: "November to April",
        currency: "MVR",
        language: "Dhivehi",
        timezone: "GMT+5",
        featured: 1,
        status: "active"
    }
];

// 2. Tour Packages (Model: TourPackage)
export const mockTourPackages = [
    {
        id: 1,
        title: "Bali Getaway Special",
        slug: "bali-getaway-special",
        destination_id: 1,
        category: "Beach Holidays",
        duration: "5 Days / 4 Nights",
        price: 1200.00,
        discount_price: 1000.00,
        max_people: 10,
        description: "Experience the ultimate tropical vacation in Bali with premium resorts, white sand beach tours, and traditional temple visits.",
        highlights: "Kuta Beach, Ubud Monkey Forest, Uluwatu Temple Sunset, Tanah Lot Temple",
        itinerary: JSON.stringify([
            { day: 1, title: "Arrival & Hotel Transfer", desc: "Arrive at Denpasar Airport and transfer to your beachfront resort in Seminyak." },
            { day: 2, title: "Ubud Culture & Swing Tour", desc: "Explore Ubud forest, take photos on the famous swing, and visit craft villages." },
            { day: 3, title: "Uluwatu Sunset Temple Tour", desc: "Visit the cliffside Uluwatu temple and watch the traditional Kecak Fire Dance." },
            { day: 4, title: "Tanah Lot Sea Temple visit", desc: "Explore Tanah Lot Temple situated on a rock in the sea, perfect for photo sessions." },
            { day: 5, title: "Departure", desc: "Breakfast at hotel and transfer to airport for departure flight." }
        ]),
        included: "Airport pickup/drop, 4-star beach resort stay, Breakfast, English-speaking guide, Tour entrance fees",
        excluded: "Airfares, Lunch & Dinners, Travel insurance, Personal items, Guide tips",
        featured_image: "https://images.unsplash.com/photo-1537996194471-e657df975ab4",
        gallery: JSON.stringify([
            "https://images.unsplash.com/photo-1537996194471-e657df975ab4",
            "https://images.unsplash.com/photo-1537953773315-2213cd2709cc"
        ]),
        featured: 1,
        status: "active"
    },
    {
        id: 2,
        title: "Swiss Alps Adventure",
        slug: "swiss-alps-adventure",
        destination_id: 2,
        category: "Mountain Adventure",
        duration: "7 Days / 6 Nights",
        price: 3450.00,
        discount_price: 0.00,
        max_people: 8,
        description: "A breathtaking alpine tour covering Zermatt, Interlaken, and Lucerne. Ski in winter or hike in summer.",
        highlights: "Matterhorn Peak view, Glacier Express ride, Mt. Titlis cable car, Lucerne lake cruise",
        itinerary: JSON.stringify([
            { day: 1, title: "Arrival in Zurich & Lucerne Train", desc: "Arrive in Zurich, take a scenic train to Lucerne. Walk through Chapel Bridge." },
            { day: 2, title: "Mt. Pilatus Golden Roundtrip", desc: "Ride boat, cogwheel railway, and cableway up to Mt. Pilatus peak." },
            { day: 3, title: "Interlaken Transfer & Lakes", desc: "Scenic transfer to Interlaken nestled between Lake Thun and Lake Brienz." },
            { day: 4, title: "Jungfraujoch - Top of Europe", desc: "Train journey to the highest railway station in Europe at 3,454m." },
            { day: 5, title: "Zermatt alpine village", desc: "Transfer to Zermatt, a car-free village directly underneath the Matterhorn peak." },
            { day: 6, title: "Matterhorn Glacier Paradise", desc: "Cable car up to the highest lookout platform in Europe with 360-degree views." },
            { day: 7, title: "Departure via Zurich", desc: "Transfer from Zermatt to Zurich Airport for your international return flight." }
        ]),
        included: "Swiss Travel Pass (1st class), 3-star and 4-star boutique hotel stays, Daily breakfast, Mountain railway tickets",
        excluded: "Ski gear rental, Lunch/Dinner, Personal items, Flights",
        featured_image: "https://images.unsplash.com/photo-1506744038136-46273834b3fb",
        gallery: JSON.stringify([
            "https://images.unsplash.com/photo-1506744038136-46273834b3fb",
            "https://images.unsplash.com/photo-1502784444187-359ac186c5bb"
        ]),
        featured: 1,
        status: "active"
    },
    {
        id: 3,
        title: "Tokyo Express Tour",
        slug: "tokyo-express-tour",
        destination_id: 3,
        category: "Cultural Tours",
        duration: "5 Days / 4 Nights",
        price: 2100.00,
        discount_price: 1850.00,
        max_people: 12,
        description: "Explore the futuristic metropolis of Tokyo. From Senso-ji temple in Asakusa to the fashion hub of Harajuku and Shibuya Crossing.",
        highlights: "Shibuya Crossing, Senso-ji temple, Tsukiji Outer Market, Mt. Fuji day excursion",
        itinerary: JSON.stringify([
            { day: 1, title: "Tokyo Arrival & Check-in", desc: "Airport transfer and welcome dinner in Shinjuku." },
            { day: 2, title: "Asakusa Temple & Skytree", desc: "Visit Tokyo's oldest temple, shop at Nakamise Street, and head up Tokyo Skytree." },
            { day: 3, title: "Harajuku & Shibuya Crossing", desc: "Explore Meiji Shrine, walk down Takeshita Street, and cross Shibuya intersection." },
            { day: 4, title: "Mt. Fuji & Lake Ashi Day Trip", desc: "Scenic bus tour to Mt. Fuji 5th station and a cruise on Lake Ashi in Hakone." },
            { day: 5, title: "Shinkansen departure or transfer", desc: "Hotel checkout and transfer to Narita or Haneda Airport." }
        ]),
        included: "Professional English guide, 4-star hotel in Shinjuku, Welcome dinner, Airport transfers, Shinkansen tickets",
        excluded: "Daily lunch/dinner, International flights, Optional activities",
        featured_image: "https://images.unsplash.com/photo-1503899036084-c55cdd92da26",
        gallery: JSON.stringify(["https://images.unsplash.com/photo-1503899036084-c55cdd92da26"]),
        featured: 1,
        status: "active"
    },
    {
        id: 4,
        title: "Rajasthan Heritage Tour",
        slug: "rajasthan-heritage-tour",
        destination_id: 4,
        category: "Cultural Tours",
        duration: "6 Days / 5 Nights",
        price: 850.00,
        discount_price: 0.00,
        max_people: 15,
        description: "Explore the pink city Jaipur, lake city Udaipur, and historic palaces. Experience royal Rajasthani hospitality.",
        highlights: "Amber Fort Amber, Hawa Mahal Jaipur, Udaipur City Palace, Lake Pichola boating",
        itinerary: JSON.stringify([
            { day: 1, title: "Arrival in Jaipur", desc: "Welcome and transfer to a heritage hotel. Evening visit to Chokhi Dhani." },
            { day: 2, title: "Jaipur City Tour", desc: "Visit Amber Fort with elephant ride, City Palace, Jantar Mantar, and Hawa Mahal." },
            { day: 3, title: "Drive to Udaipur via Chittorgarh", desc: "Scenic road trip to Udaipur stopping at the massive Chittorgarh Fort." },
            { day: 4, title: "Udaipur Lakes & Palaces", desc: "Explore City Palace museum, Crystal Gallery, and boat ride at Lake Pichola." },
            { day: 5, title: "Sajjangarh Fort (Monsoon Palace)", desc: "Panoramic view of Udaipur lakes from Sajjangarh and shopping for handicrafts." },
            { day: 6, title: "Udaipur Departure", desc: "Checkout and transfer to Udaipur Airport or Railway Station." }
        ]),
        included: "Private AC car with driver, Heritage hotel accommodations, Local tour guides, Daily breakfast, Entry fees",
        excluded: "Dinners/Lunches, Flights, Boating tickets, Camera charges",
        featured_image: "https://images.unsplash.com/photo-1477587458883-471a5ed08bc4",
        gallery: JSON.stringify(["https://images.unsplash.com/photo-1477587458883-471a5ed08bc4"]),
        featured: 0,
        status: "active"
    }
];

// 3. Customers (Model: Customer)
export const mockCustomers = [
    {
        id: 1,
        first_name: "John",
        last_name: "Doe",
        email: "john.doe@gmail.com",
        phone: "+1 555-0199",
        gender: "Male",
        dob: "1985-05-12",
        passport: "US8901234",
        nationality: "American",
        address: "128 Baker Street",
        city: "London",
        country: "United Kingdom",
        status: "active",
        passport_verified: 1
    },
    {
        id: 2,
        first_name: "Sarah",
        last_name: "Jenkins",
        email: "sarah.j@hotmail.com",
        phone: "+44 7911 123456",
        gender: "Female",
        dob: "1992-09-24",
        passport: "UK4567890",
        nationality: "British",
        address: "56 High Street",
        city: "Lucerne",
        country: "Switzerland",
        status: "active",
        passport_verified: 0
    },
    {
        id: 3,
        first_name: "Amit",
        last_name: "Sharma",
        email: "amit.s@gmail.com",
        phone: "+91 98765 43210",
        gender: "Male",
        dob: "1989-11-04",
        passport: "IN789012",
        nationality: "Indian",
        address: "Block C-2, Saket",
        city: "New Delhi",
        country: "India",
        status: "inactive",
        passport_verified: 1
    },
    {
        id: 4,
        first_name: "Michael",
        last_name: "Brown",
        email: "mbrown@yahoo.com",
        phone: "+1 555-0348",
        gender: "Male",
        dob: "1978-02-18",
        passport: "US5612348",
        nationality: "American",
        address: "742 Evergreen Terrace",
        city: "Springfield",
        country: "United States",
        status: "active",
        passport_verified: 1
    }
];

// 4. Bookings (Model: Booking)
export const mockBookings = [
    {
        id: 1,
        booking_number: "BK-8932",
        customer_id: 1,
        package_id: 1,
        flight_id: 101,
        hotel_id: 201,
        travel_date: "2026-06-15",
        persons: 2,
        total_amount: 2400.00,
        discount_amount: 400.00,
        final_amount: 2000.00,
        payment_status: "completed",
        booking_status: "confirmed",
        notes: "Requesting ocean-view room if available."
    },
    {
        id: 2,
        booking_number: "BK-8931",
        customer_id: 2,
        package_id: 2,
        flight_id: null,
        hotel_id: 202,
        travel_date: "2026-08-10",
        persons: 1,
        total_amount: 3450.00,
        discount_amount: 0.00,
        final_amount: 3450.00,
        payment_status: "pending",
        booking_status: "pending",
        notes: "Need Swiss rail map pass."
    },
    {
        id: 3,
        booking_number: "BK-8930",
        customer_id: 3,
        package_id: 4,
        flight_id: null,
        hotel_id: null,
        travel_date: "2026-10-05",
        persons: 4,
        total_amount: 3400.00,
        discount_amount: 200.00,
        final_amount: 3200.00,
        payment_status: "failed",
        booking_status: "cancelled",
        notes: "Payment got rejected by card issuer twice."
    },
    {
        id: 4,
        booking_number: "BK-8929",
        customer_id: 4,
        package_id: 3,
        flight_id: 103,
        hotel_id: 203,
        travel_date: "2026-07-20",
        persons: 2,
        total_amount: 4200.00,
        discount_amount: 500.00,
        final_amount: 3700.00,
        payment_status: "completed",
        booking_status: "confirmed",
        notes: "Wants vegetarian meals on the flights."
    }
];

// 5. Payments (Model: Payment)
export const mockPayments = [
    {
        id: 1,
        booking_id: 1,
        customer_id: 1,
        transaction_id: "TXN-74893012",
        amount: 2000.00,
        payment_method: "Credit Card",
        gateway: "Stripe",
        gateway_response: JSON.stringify({ status: "succeeded", code: "ch_893A021J" }),
        payment_status: "completed",
        paid_at: "2026-05-24 10:15:30"
    },
    {
        id: 2,
        booking_id: 4,
        customer_id: 4,
        transaction_id: "TXN-74892945",
        amount: 3700.00,
        payment_method: "PayPal",
        gateway: "PayPal SDK",
        gateway_response: JSON.stringify({ status: "approved", paymentId: "PAYID-LOKI9" }),
        payment_status: "completed",
        paid_at: "2026-05-21 14:45:10"
    },
    {
        id: 3,
        booking_id: 3,
        customer_id: 3,
        transaction_id: "TXN-74892900",
        amount: 3200.00,
        payment_method: "Credit Card",
        gateway: "Razorpay",
        gateway_response: JSON.stringify({ status: "failed", error: "insufficient_funds" }),
        payment_status: "failed",
        paid_at: "2026-05-22 09:30:15"
    }
];

// 6. Hotels (Model: Hotel)
export const mockHotels = [
    {
        id: 201,
        name: "Seminyak Beach Resort & Spa",
        destination_id: 1,
        rating: 5,
        address: "Jalan Kayu Aya, Seminyak",
        price_per_night: 220.00,
        status: "active"
    },
    {
        id: 202,
        name: "Hotel Interlaken",
        destination_id: 2,
        rating: 4,
        address: "Hoheweg 74, Interlaken",
        price_per_night: 310.00,
        status: "active"
    },
    {
        id: 203,
        name: "Shinjuku Granbell Hotel",
        destination_id: 3,
        rating: 4,
        address: "Kabukicho 2-14-5, Tokyo",
        price_per_night: 180.00,
        status: "active"
    }
];

// 7. Flights (Model: Flight)
export const mockFlights = [
    {
        id: 101,
        flight_number: "SQ-947",
        airline: "Singapore Airlines",
        departure_airport: "SIN",
        arrival_airport: "DPS",
        departure_time: "10:30 AM",
        price: 450.00,
        status: "active"
    },
    {
        id: 103,
        flight_number: "JL-006",
        airline: "Japan Airlines",
        departure_airport: "JFK",
        arrival_airport: "HND",
        departure_time: "11:45 AM",
        price: 1100.00,
        status: "active"
    }
];

// 8. Staff / Employees (Model: Staff)
export const mockStaff = [
    {
        id: 1,
        name: "Admin Staff",
        email: "admin@travelerp.com",
        phone: "+1 555-0100",
        role: "admin",
        status: "active"
    },
    {
        id: 2,
        name: "Emma Watson",
        email: "emma.w@travelerp.com",
        phone: "+1 555-0102",
        role: "agent",
        status: "active"
    },
    {
        id: 3,
        name: "Rahul Verma",
        email: "rahul@travelerp.com",
        phone: "+91 99999 88888",
        role: "accountant",
        status: "active"
    }
];

// Helper functions for data queries (mimicking Laravel Eloquent logic)
export const getCustomerById = (id) => mockCustomers.find(c => c.id === id);
export const getPackageById = (id) => mockTourPackages.find(p => p.id === id);
export const getDestinationById = (id) => mockDestinations.find(d => d.id === id);
export const getHotelById = (id) => mockHotels.find(h => h.id === id);
export const getFlightById = (id) => mockFlights.find(f => f.id === id);

export const getBookingDetails = (bookingId) => {
    const booking = mockBookings.find(b => b.id === bookingId);
    if (!booking) return null;
    
    return {
        ...booking,
        customer: getCustomerById(booking.customer_id),
        package: getPackageById(booking.package_id),
        hotel: getHotelById(booking.hotel_id),
        flight: getFlightById(booking.flight_id)
    };
};

export const getPaymentDetails = (paymentId) => {
    const payment = mockPayments.find(p => p.id === paymentId);
    if (!payment) return null;

    const booking = mockBookings.find(b => b.id === payment.booking_id);
    return {
        ...payment,
        customer: getCustomerById(payment.customer_id),
        booking: booking,
        package: booking ? getPackageById(booking.package_id) : null
    };
};
