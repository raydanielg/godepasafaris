# Go Deep Africa Safari - API Documentation

## Base URL
```
https://godeepafricasafari.com/api
```

## Authentication
All protected routes require Bearer token authentication. Include the token in the Authorization header:
```
Authorization: Bearer {token}
```

---

## Authentication Endpoints

### Register User
**POST** `/api/register`

Register a new user account.

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "phone": "+255123456789"
}
```

**Response (201):**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+255123456789",
      "role": "user"
    },
    "token": "1|abc123xyz..."
  }
}
```

---

### Login User
**POST** `/api/login`

Authenticate user and get access token.

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "token": "1|abc123xyz..."
  }
}
```

---

### Get User Profile
**GET** `/api/user`

Get authenticated user's profile.

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+255123456789",
    "role": "user"
  }
}
```

---

### Update Profile
**PUT** `/api/profile`

Update authenticated user's profile.

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "name": "John Updated",
  "email": "johnupdated@example.com",
  "phone": "+255987654321"
}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Profile updated successfully",
  "data": {
    "id": 1,
    "name": "John Updated",
    "email": "johnupdated@example.com",
    "phone": "+255987654321"
  }
}
```

---

### Logout
**POST** `/api/logout`

Logout user and revoke current token.

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

---

## Safari Packages Endpoints

### Get All Safari Packages
**GET** `/api/safaris`

Get all active safari packages with optional filters.

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `category` (optional): Filter by category (e.g., Safari, Mountain, Beach)
- `featured` (optional): Filter featured packages (true/false)
- `min_days` (optional): Minimum number of days
- `max_days` (optional): Maximum number of days
- `min_price` (optional): Minimum price
- `max_price` (optional): Maximum price
- `search` (optional): Search in title, summary, description
- `per_page` (optional): Items per page (default: 15)

**Example:**
```
GET /api/safaris?category=Safari&featured=true&min_days=5&max_days=10&per_page=20
```

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "6 Day Tanzania Migration Safari",
      "slug": "6-day-tanzania-migration-safari",
      "summary": "This 6 day safari in Tanzania...",
      "description": "Full description...",
      "price": 2370,
      "currency": "USD",
      "days": 6,
      "category": "Safari",
      "group_discount": 10,
      "min_group_size": 2,
      "is_featured": true,
      "is_active": true,
      "image": "images/safaris/...",
      "itinerary": [
        {
          "day": 1,
          "title": "Arrival & Ngorongoro Crater",
          "description": "Upon arrival...",
          "image": "images/..."
        }
      ],
      "inclusions": [
        "Airport pick-up and drop-off",
        "Accommodation at chosen lodges"
      ],
      "exclusions": [
        "International flights",
        "Visa fees"
      ]
    }
  ],
  "pagination": {
    "total": 50,
    "per_page": 15,
    "current_page": 1,
    "last_page": 4
  }
}
```

---

### Get Single Safari Package
**GET** `/api/safaris/{slug}`

Get details of a specific safari package.

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "6 Day Tanzania Migration Safari",
    "slug": "6-day-tanzania-migration-safari",
    "summary": "This 6 day safari in Tanzania...",
    "description": "Full description...",
    "price": 2370,
    "currency": "USD",
    "days": 6,
    "category": "Safari",
    "group_discount": 10,
    "min_group_size": 2,
    "is_featured": true,
    "is_active": true,
    "image": "images/safaris/...",
    "itinerary": [...],
    "inclusions": [...],
    "exclusions": [...]
  }
}
```

---

### Get Featured Safari Packages
**GET** `/api/safaris/featured`

Get featured safari packages.

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `limit` (optional): Number of items to return (default: 6)

**Example:**
```
GET /api/safaris/featured?limit=10
```

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "6 Day Tanzania Migration Safari",
      "slug": "6-day-tanzania-migration-safari",
      "price": 2370,
      "currency": "USD",
      "days": 6,
      "is_featured": true,
      "image": "images/safaris/..."
    }
  ]
}
```

---

## Destinations Endpoints

### Get All Destinations
**GET** `/api/destinations`

Get all active destinations with optional filters.

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `category` (optional): Filter by category
- `search` (optional): Search in title, description
- `per_page` (optional): Items per page (default: 15)

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Serengeti National Park",
      "slug": "serengeti-national-park",
      "category": "National Parks",
      "description": "The Serengeti ecosystem...",
      "image": "images/destinations/...",
      "rate_range": "$200-$500",
      "best_time": "June-October",
      "high_season": "June-October",
      "country": "Tanzania"
    }
  ],
  "pagination": {
    "total": 20,
    "per_page": 15,
    "current_page": 1,
    "last_page": 2
  }
}
```

---

### Get Single Destination
**GET** `/api/destinations/{slug}`

Get details of a specific destination.

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Serengeti National Park",
    "slug": "serengeti-national-park",
    "category": "National Parks",
    "description": "The Serengeti ecosystem...",
    "image": "images/destinations/...",
    "rate_range": "$200-$500",
    "best_time": "June-October",
    "high_season": "June-October",
    "country": "Tanzania"
  }
}
```

---

## Bookings Endpoints

### Create Booking
**POST** `/api/bookings`

Create a new booking for a safari package.

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "safari_package_id": 1,
  "travel_date": "2024-07-15",
  "travelers": 2,
  "message": "I would like to book this safari for my family."
}
```

**Response (201):**
```json
{
  "success": true,
  "message": "Booking created successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "safari_package_id": 1,
    "tour_name": "6 Day Tanzania Migration Safari",
    "travel_date": "2024-07-15",
    "travelers": 2,
    "message": "I would like to book this safari for my family.",
    "status": "pending",
    "created_at": "2024-06-03T20:00:00.000000Z"
  }
}
```

---

### Get User's Bookings
**GET** `/api/bookings`

Get all bookings for the authenticated user.

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `per_page` (optional): Items per page (default: 15)

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "safari_package_id": 1,
      "tour_name": "6 Day Tanzania Migration Safari",
      "travel_date": "2024-07-15",
      "travelers": 2,
      "message": "I would like to book this safari for my family.",
      "status": "pending",
      "created_at": "2024-06-03T20:00:00.000000Z",
      "safari_package": {
        "id": 1,
        "title": "6 Day Tanzania Migration Safari",
        "slug": "6-day-tanzania-migration-safari",
        "price": 2370,
        "currency": "USD",
        "days": 6,
        "image": "images/safaris/..."
      }
    }
  ],
  "pagination": {
    "total": 5,
    "per_page": 15,
    "current_page": 1,
    "last_page": 1
  }
}
```

---

### Get Single Booking
**GET** `/api/bookings/{id}`

Get details of a specific booking.

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "safari_package_id": 1,
    "tour_name": "6 Day Tanzania Migration Safari",
    "travel_date": "2024-07-15",
    "travelers": 2,
    "message": "I would like to book this safari for my family.",
    "status": "pending",
    "created_at": "2024-06-03T20:00:00.000000Z",
    "safari_package": {
      "id": 1,
      "title": "6 Day Tanzania Migration Safari",
      "slug": "6-day-tanzania-migration-safari",
      "price": 2370,
      "currency": "USD",
      "days": 6,
      "image": "images/safaris/..."
    }
  }
}
```

---

## Error Responses

### Validation Error (422)
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 8 characters."]
  }
}
```

### Unauthorized (401)
```json
{
  "success": false,
  "message": "Invalid credentials"
}
```

### Not Found (404)
```json
{
  "success": false,
  "message": "Resource not found"
}
```

### Server Error (500)
```json
{
  "success": false,
  "message": "Internal server error"
}
```

---

## Status Codes

- `200` - Success
- `201` - Created
- `401` - Unauthorized
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## Notes

1. All dates should be in ISO 8601 format (YYYY-MM-DD)
2. All prices are in the specified currency (default: USD)
3. Images are relative paths from the public directory
4. Itinerary, inclusions, and exclusions are stored as JSON arrays
5. All protected routes require a valid Bearer token
6. Tokens are revoked on logout
