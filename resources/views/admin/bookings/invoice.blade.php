<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Go Deep Africa Safari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 40px 0; }
        .invoice-card { background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; max-width: 900px; margin: 0 auto; }
        .invoice-header { background: #3E2723; color: white; padding: 40px; }
        .invoice-body { padding: 40px; }
        .invoice-footer { background: #fdfaf5; padding: 30px; border-top: 1px solid #eee; text-align: center; }
        .text-earth { color: #8b4513; }
        .table th { background-color: #fdfaf5; color: #3E2723; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; background: white; }
            .invoice-card { box-shadow: none; border: 1px solid #eee; }
        }
    </style>
</head>
<body>
    <div class="container mb-4 no-print text-center">
        <button onclick="window.print()" class="btn btn-dark px-5 rounded-pill shadow">
            <i class="fas fa-print me-2"></i>Print / Download PDF
        </button>
    </div>

    <div class="invoice-card">
        <div class="invoice-header">
            <div class="row align-items-center">
                <div class="col-sm-6 text-center text-sm-start">
                    <h2 class="fw-bold mb-0">PROFORMA INVOICE</h2>
                    <p class="opacity-75 mb-0">Booking Reference: #GDA-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="col-sm-6 text-center text-sm-end mt-4 mt-sm-0">
                    <h4 class="fw-bold mb-0 text-uppercase">Go Deep Africa</h4>
                    <p class="small mb-0 opacity-75">Arusha, Tanzania</p>
                    <p class="small mb-0 opacity-75">info@godeepafricasafari.com</p>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <h6 class="text-muted text-uppercase small fw-bold mb-3">Bill To:</h6>
                    <h5 class="fw-bold mb-1">{{ $booking->name }}</h5>
                    <p class="text-muted mb-1">{{ $booking->email }}</p>
                    <p class="text-muted mb-0">{{ $booking->phone }}</p>
                </div>
                <div class="col-sm-6 text-sm-end mt-4 mt-sm-0">
                    <h6 class="text-muted text-uppercase small fw-bold mb-3">Invoice Details:</h6>
                    <p class="mb-1"><strong>Date:</strong> {{ now()->format('M d, Y') }}</p>
                    <p class="mb-0"><strong>Status:</strong> <span class="text-earth fw-bold text-uppercase">{{ $booking->status }}</span></p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="border-bottom">
                            <th class="py-3">Description</th>
                            <th class="py-3 text-center">Qty</th>
                            <th class="py-3 text-end">Price</th>
                            <th class="py-3 text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="py-4">
                                <h6 class="fw-bold mb-1">{{ $booking->tour_name }}</h6>
                                <p class="small text-muted mb-0">Travel Date: {{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : 'TBD' }}</p>
                                <p class="small text-muted mb-0">Accommodation: {{ ucfirst($booking->accommodation ?? 'Standard') }}</p>
                            </td>
                            <td class="py-4 text-center">{{ $booking->travelers }} Pax</td>
                            <td class="py-4 text-end">TBD</td>
                            <td class="py-4 text-end fw-bold text-earth">QUOTE REQUEST</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end mt-5">
                <div class="col-sm-5">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Package Total:</span>
                        <span class="fw-bold">TBD</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Tax (VAT 18%):</span>
                        <span class="fw-bold">Incl.</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-3">
                        <h5 class="fw-bold">Grand Total:</h5>
                        <h4 class="fw-bold text-earth">CONTACT US</h4>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top">
                <h6 class="fw-bold text-uppercase small mb-3">Payment Terms & Instructions:</h6>
                <p class="small text-muted">A 30% deposit is required to secure the booking. The remaining 70% is due 45 days before the departure. Payments can be made via Bank Transfer or Credit Card (3.5% processing fee apply for cards).</p>
            </div>
        </div>

        <div class="invoice-footer">
            <p class="mb-1 fw-bold">Thank you for choosing Go Deep Africa Safari!</p>
            <p class="small text-muted mb-0">www.godeepafricasafari.com | +255 794 636 471</p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>
