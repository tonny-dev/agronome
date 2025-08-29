# Soil Testing System - Implementation Guide

## Overview

Complete implementation of the Chemical Soil Testing system for the Agronome platform, featuring booking, kit inventory, payment integration, guided testing workflow, SMS uplink, results gating, and historical analytics.

## Features Implemented

### Core Workflow
- ✅ Farm selection with auto-populated details
- ✅ Chemical test type selection with testing guide
- ✅ Vendor search by proximity and real-time inventory
- ✅ 4-day booking window (pickup → test → return → allowance)
- ✅ MPesa/Airtel payment integration (mock)
- ✅ Dual confirmation pickup/return flow
- ✅ Sequential sample collection with GPS logging
- ✅ SMS dispatch for each depth result
- ✅ Results gating until kit return validation
- ✅ Historical test browsing and filtering

### Technical Implementation
- ✅ Laravel 11 compatible migrations and models
- ✅ Eloquent relationships with proper constraints
- ✅ State machine for soil test status transitions
- ✅ Service layer architecture (BookingService, InventoryService, PaymentsService)
- ✅ Queue jobs for SMS dispatch and inventory management
- ✅ Policy-based authorization
- ✅ Vue 3 + Inertia frontend components
- ✅ Comprehensive feature tests

## Database Schema

### Core Tables
- `farms` - Extended with location data and size
- `vendors` - Agro-vet centers and extension offices
- `kits` - Soil testing kit inventory
- `soil_tests` - Main test records with state machine
- `sampling_plans` - Generated from farm size
- `sample_locations` - GPS coordinates for each sample
- `depth_results` - Surface and sub-surface test data
- `payments` - MPesa/Airtel payment tracking
- `returns` - Kit return and diagnostics validation

## Setup Instructions

### 1. Database Migration
```bash
php artisan migrate
php artisan db:seed --class=SoilTestingSeeder
```

### 2. Environment Configuration
Add to `.env`:
```env
# Payment Gateway (Mock for development)
MPESA_CONSUMER_KEY=your_key
MPESA_CONSUMER_SECRET=your_secret
MPESA_SHORTCODE=your_shortcode

# SMS Service
SMS_ENDPOINT=https://your-sms-service.com/api/send
SMS_API_KEY=your_sms_key

# Queue Configuration
QUEUE_CONNECTION=database
```

### 3. Queue Workers
Start queue workers for background jobs:
```bash
php artisan queue:work --queue=default,sms,payments
```

### 4. Frontend Assets
```bash
npm install
npm run dev
```

## API Endpoints

### Main Workflow
- `GET /soil/dashboard` - Main dashboard
- `POST /soil/tests` - Create new test
- `GET /vendors/nearby` - Find vendors by location
- `POST /soil/tests/{id}/book` - Book test with vendor
- `POST /soil/tests/{id}/pay` - Initiate payment
- `POST /soil/tests/{id}/confirm-pickup` - Confirm pickup
- `POST /samples/{id}/record` - Record sample data

### Webhooks
- `POST /payments/webhook` - Payment confirmation

## Business Rules Enforced

### Sampling Plan
- Automatically generated from farm size
- Immutable sequence once testing starts
- Next sample only enabled after previous completion

### Kit Inventory
- Real-time availability checking
- Automatic hold on booking (15-minute timeout)
- Distance-based vendor ranking

### Payment Gating
- Pickup disabled until payment confirmed
- Date validation (pickup < testing < dropoff)
- Automatic date calculations

### Results Gating
- Basic feedback during testing
- Detailed analysis locked until return
- Vendor diagnostics must pass
- User confirmation required

## State Machine

```
draft → booked → paid → picked_up → testing → awaiting_return → returned → analysis_unlocked
```

### Transition Guards
- `booked`: Inventory hold successful
- `paid`: Payment confirmed via webhook
- `picked_up`: Vendor + user confirmation + time window
- `testing`: Auto-transition, enables sample sequence
- `awaiting_return`: All samples completed
- `returned`: Vendor diagnostics pass + confirmations
- `analysis_unlocked`: Detailed results available

## Testing

### Run Feature Tests
```bash
php artisan test --filter=SoilTestingWorkflowTest
```

### Test Coverage
- Complete happy path workflow
- Sequential sample enforcement
- Payment status gating
- Authorization policies
- Date validation rules

## Demo Data

The seeder creates:
- 3 vendors with mixed kit availability
- 5 farms with varying sizes
- 2 historical tests (completed + in-progress)
- Realistic GPS coordinates for Kenya

## Integration Points

### Payment Gateways
- Mock implementation for development
- Production: Replace `PaymentsService::callPaymentGateway()`
- Webhook handler processes confirmations

### SMS Service
- Mock dispatch for development
- Production: Configure SMS_ENDPOINT in .env
- Retry logic with DLQ for failures

### GPS/Mapping
- Sample locations calculated from farm boundaries
- Elevation data mocked (integrate with DEM service)
- Admin boundary integration ready

## Security Considerations

- CSRF protection on all forms
- Policy-based authorization
- Input validation and sanitization
- Soft deletes for audit trail
- Payment webhook signature verification (implement in production)

## Performance Optimizations

- Database indexes on frequently queried columns
- Eager loading for relationships
- Queue jobs for heavy operations
- Pagination for historical data

## Monitoring & Logging

- SMS dispatch status tracking
- Payment webhook logging
- Kit inventory audit trail
- Test status transition logs

## Next Steps for Production

1. **Payment Integration**: Replace mock with actual MPesa/Airtel APIs
2. **SMS Service**: Configure real SMS provider
3. **Mapping**: Integrate with mapping service for boundaries
4. **Notifications**: Add email/SMS notifications for status changes
5. **Analytics**: Dashboard for vendor performance and test statistics
6. **Mobile App**: Extend for field data collection
7. **Reporting**: PDF/Excel export for test results

## Support

For technical issues or feature requests, refer to the main project documentation or contact the development team.
