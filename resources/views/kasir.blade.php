<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Kasir / POS</title>
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .kasir-container {
            padding: 20px;
        }
        .cart-table th {
            background-color: #0d6efd;
            color: white;
        }
        .empty-cart {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        .qty-control {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .qty-control input {
            width: 50px;
            text-align: center;
        }
        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 2px 8px;
            cursor: pointer;
        }
        .short-payment {
            background-color: #f8d7da !important;
            color: #842029 !important;
        }

        /* ==========================================
           STYLE KHUSUS STRUK THERMAL CETAK
        ========================================== */
        @media print {
            body * {
                visibility: hidden !important;
            }
            #receipt-print-area, #receipt-print-area * {
                visibility: visible !important;
            }
            #receipt-print-area {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 58mm !important; /* Ukuran standar printer thermal */
                font-family: 'Courier New', Courier, monospace !important;
                font-size: 11px !important;
                color: #000 !important;
                padding: 5px !important;
            }
            @page {
                margin: 0;
                size: auto;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid kasir-container">
    <div class="row">
        <!-- HEADER KASIR -->
        <div class="col-12 mb-3 d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm">
            <h4 class="m-0 font-weight-bold text-primary">Sistem Kasir (POS)</h4>
            <div>
                <span class="me-3 fw-bold" id="currentDate"></span>
                <button class="btn btn-warning btn-sm" onclick="holdTransaction()">Tahan (Hold)</button>
                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#holdModal">
                    Daftar Hold (<span id="holdCount">0</span>)
                </button>
                <button class="btn btn-danger btn-sm" onclick="cancelTransaction()">Batal (Esc)</button>
            </div>
        </div>

        <!-- KOLOM KIRI: CARI BARANG & TABEL KERANJANG -->
        <div class="col-md-7">
            <div class="card shadow-sm mb-3 position-relative">
                <div class="card-body">
                    <label class="form-label fw-bold">Cari / Scan Barcode (F2)</label>
                    <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Ketik nama atau scan barcode barang..." autocomplete="off">
                    <div id="productResults" class="list-group position-absolute w-100 shadow mt-1" style="display:none; z-index: 1000; left:0; right:0;"></div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped cart-table m-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Produk</th>
                                <th width="20%">Harga</th>
                                <th width="20%">Qty</th>
                                <th width="20%" class="text-end">Subtotal</th>
                                <th width="5%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <!-- Render otomatis via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: DETAIL & PEMBAYARAN -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2 align-items-center">
                        <label class="form-label m-0 fw-bold">Pelanggan:</label>
                        <select id="customerSelect" class="form-select form-select-sm w-50">
                            <option value="">-- Umum --</option>
                        </select>
                    </div>

                    <hr class="my-2">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Qty:</span>
                        <span id="totalQty" class="fw-bold">0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal" class="fw-bold">Rp 0</span>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small mb-1">Diskon (%)</label>
                            <input type="number" id="discountPercent" class="form-control form-control-sm" value="0" onchange="calculateTotal()" onkeyup="calculateTotal()">
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1">Diskon (Rp)</label>
                            <input type="number" id="discountAmount" class="form-control form-control-sm" value="0" onchange="calculateTotal()" onkeyup="calculateTotal()">
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small mb-1">Pajak (Rp)</label>
                            <input type="number" id="tax" class="form-control form-control-sm" value="0" onchange="calculateTotal()" onkeyup="calculateTotal()">
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1">Biaya Lain (Rp)</label>
                            <input type="number" id="otherFee" class="form-control form-control-sm" value="0" onchange="calculateTotal()" onkeyup="calculateTotal()">
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded mb-3 text-center border">
                        <div class="text-muted small">TOTAL BAYAR</div>
                        <h2 id="grandTotal" class="text-primary fw-bold m-0">Rp 0</h2>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran</label>
                        <div class="d-flex gap-2 payment-method">
                            <button class="btn btn-outline-primary active w-100" onclick="selectPayment(this)">Tunai</button>
                            <button class="btn btn-outline-primary w-100" onclick="selectPayment(this)">QRIS</button>
                            <button class="btn btn-outline-primary w-100" onclick="selectPayment(this)">Transfer</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jumlah Uang / Bayar (F4)</label>
                        <input type="number" id="payment" class="form-control form-control-lg fw-bold" placeholder="0" oninput="calculateChange()">
                        <div class="d-flex gap-2 mt-2">
                            <button class="btn btn-sm btn-outline-secondary w-100" onclick="setExactCash()">Uang Pas</button>
                            <button class="btn btn-sm btn-outline-secondary w-100" onclick="setQuickCash(50000)">50.000</button>
                            <button class="btn btn-sm btn-outline-secondary w-100" onclick="setQuickCash(100000)">100.000</button>
                        </div>
                    </div>

                    <div id="changeBox" class="alert alert-success d-flex justify-content-between align-items-center mb-3">
                        <span class="change-label fw-bold">KEMBALIAN</span>
                        <h3 id="change" class="m-0 fw-bold">Rp 0</h3>
                    </div>

                    <button id="btnPay" class="btn btn-success btn-lg w-100 fw-bold py-3" onclick="processPayment()">
                        BAYAR & CETAK
                    </button>

                    <div id="invoiceActions" class="d-none mt-3">
                        <div class="d-grid gap-2">
                            <a id="invoicePreviewLink" class="btn btn-outline-primary w-100" target="_blank" rel="noopener noreferrer">
                                Lihat Invoice
                            </a>
                            <button id="printInvoiceButton" class="btn btn-outline-dark w-100" type="button" onclick="printLastInvoice()">
                                Print Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DAFTAR TRANSAKSI DITAHAN -->
<div class="modal fade" id="holdModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Transaksi Ditahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Trx</th>
                            <th>Total Item</th>
                            <th>Total Rp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="holdTableBody">
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada transaksi yang ditahan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     TEMPLATE STRUK UNTUK CETAK THERMAL
========================================== -->
<div id="receipt-print-area" style="display: none;">
    <div style="text-align: center; margin-bottom: 8px;">
        <h4 style="margin: 0; font-weight: bold; font-size: 14px;">TOKO RETAIL MAKMUR</h4>
        <div style="font-size: 10px;">Jl. Contoh No. 123 • Jember</div>
        <div style="font-size: 10px;">Telp. 0812-xxxx-xxxx</div>
        <div>--------------------------------</div>
    </div>

    <div style="margin-bottom: 8px;">
        <div>Tgl : <span id="printDate"></span></div>
        <div>Kasir : Admin</div>
        <div>--------------------------------</div>
    </div>

    <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
        <tbody id="printCartItems"></tbody>
    </table>
    <div>--------------------------------</div>

    <div style="display: flex; justify-content: space-between; font-weight: bold; margin-top: 4px;">
        <span>TOTAL:</span>
        <span id="printGrandTotal">Rp 0</span>
    </div>
    <div style="display: flex; justify-content: space-between; margin-top: 4px;">
        <span>Bayar:</span>
        <span id="printPaid">Rp 0</span>
    </div>
    <div style="display: flex; justify-content: space-between;">
        <span>Kembali:</span>
        <span id="printChange">Rp 0</span>
    </div>

    <div style="text-align: center; margin-top: 12px; font-size: 10px;">
        ================================<br>
        Terima Kasih Atas Kunjungan Anda!<br>
        Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan.
    </div>
</div>

<!-- JS BOOTSTRAP 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- PENAMPUNG DATA PRODUK (Mencegah error 'Decorators are not valid' di VS Code) -->
<script id="products-data" type="application/json">
    @json($products ?? [])
</script>

<!-- JAVASCRIPT LOGIKA KASIR -->
<script>
    // Membaca data JSON dari tag penampung produk
    let products = JSON.parse(document.getElementById("products-data")?.textContent || "[]");
    let cart = [];
    let heldTransactions = [];
    let lastInvoiceUrl = "";

    const searchInput = document.getElementById("searchInput");

    /* --------------------------------------------------
       1. FORMAT CURRENCY & CARI PRODUK
    -------------------------------------------------- */
    function formatRupiah(value) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0
        }).format(value);
    }

    if (searchInput) {
        searchInput.addEventListener("input", function() {
            const query = this.value.toLowerCase().trim();
            const resultsContainer = document.getElementById("productResults");

            if (query.length === 0) {
                resultsContainer.style.display = "none";
                return;
            }

            const filtered = products.filter(p => 
                p.name.toLowerCase().includes(query) || 
                (p.code && p.code.toLowerCase().includes(query))
            );

            if (filtered.length === 0) {
                resultsContainer.style.display = "none";
                return;
            }

            resultsContainer.innerHTML = filtered.map(p => `
                <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="addToCart(${p.id})">
                    <div>
                        <strong>${p.name}</strong>
                        <div class="small text-muted">${p.code || ''}</div>
                    </div>
                    <span class="badge bg-primary rounded-pill">${formatRupiah(p.price)}</span>
                </button>
            `).join("");

            resultsContainer.style.display = "block";
        });
    }

    /* --------------------------------------------------
       2. MANAJEMEN KERANJANG
    -------------------------------------------------- */
    function addToCart(productId) {
        const product = products.find((p) => p.id === productId);
        if (!product) return;

        const existing = cart.find((item) => item.id === productId);

        if (existing) {
            existing.qty++;
        } else {
            cart.push({ ...product, qty: 1 });
        }

        if (searchInput) searchInput.value = "";
        document.getElementById("productResults").style.display = "none";
        renderCart();
    }

    function renderCart() {
        const body = document.getElementById("cartBody");

        if (cart.length === 0) {
            body.innerHTML = `
                <tr>
                    <td colspan="6" class="empty-cart">
                        Keranjang masih kosong.<br>Silakan cari atau scan barcode barang.
                    </td>
                </tr>
            `;
            calculateTotal();
            return;
        }

        body.innerHTML = cart
            .map(
                (item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <strong>${item.name}</strong>
                        <div style="font-size:11px; color:#6c757d">${item.code || ''}</div>
                    </td>
                    <td>${formatRupiah(item.price)}</td>
                    <td>
                        <div class="qty-control">
                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${item.id}, -1)">-</button>
                            <input type="number" class="form-control form-control-sm" value="${item.qty}" min="1" onchange="updateQty(${item.id}, this.value)">
                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${item.id}, 1)">+</button>
                        </div>
                    </td>
                    <td class="text-end">
                        <strong>${formatRupiah(item.price * item.qty)}</strong>
                    </td>
                    <td class="text-center">
                        <button class="remove-btn" onclick="removeItem(${item.id})">x</button>
                    </td>
                </tr>
            `
            )
            .join("");

        calculateTotal();
    }

    function changeQty(id, amount) {
        const item = cart.find((item) => item.id === id);
        if (!item) return;
        item.qty += amount;
        if (item.qty <= 0) {
            removeItem(id);
            return;
        }
        renderCart();
    }

    function updateQty(id, qty) {
        const item = cart.find((item) => item.id === id);
        if (!item) return;
        item.qty = Math.max(1, parseInt(qty) || 1);
        renderCart();
    }

    function removeItem(id) {
        cart = cart.filter((item) => item.id !== id);
        renderCart();
    }

    /* --------------------------------------------------
       3. HITUNG TOTAL & KEMBALIAN
    -------------------------------------------------- */
    function calculateTotal() {
        let totalQty = 0;
        let subtotal = 0;

        cart.forEach((item) => {
            totalQty += item.qty;
            subtotal += item.price * item.qty;
        });

        const discountPercent = parseFloat(document.getElementById("discountPercent")?.value) || 0;
        const manualDiscount = parseFloat(document.getElementById("discountAmount")?.value) || 0;
        const tax = parseFloat(document.getElementById("tax")?.value) || 0;
        const otherFee = parseFloat(document.getElementById("otherFee")?.value) || 0;

        const percentDiscount = subtotal * (discountPercent / 100);
        const totalDiscount = percentDiscount + manualDiscount;
        const grandTotal = Math.max(0, subtotal - totalDiscount + tax + otherFee);

        if (document.getElementById("totalQty")) document.getElementById("totalQty").innerText = totalQty;
        if (document.getElementById("subtotal")) document.getElementById("subtotal").innerText = formatRupiah(subtotal);
        if (document.getElementById("grandTotal")) document.getElementById("grandTotal").innerText = formatRupiah(grandTotal);

        calculateChange();
    }

    function getGrandTotal() {
        let subtotal = 0;
        cart.forEach((item) => subtotal += item.price * item.qty);

        const discountPercent = parseFloat(document.getElementById("discountPercent")?.value) || 0;
        const discountAmount = parseFloat(document.getElementById("discountAmount")?.value) || 0;
        const tax = parseFloat(document.getElementById("tax")?.value) || 0;
        const otherFee = parseFloat(document.getElementById("otherFee")?.value) || 0;

        const discount = (subtotal * discountPercent) / 100 + discountAmount;
        return Math.max(0, subtotal - discount + tax + otherFee);
    }

    function calculateChange() {
        const grandTotal = getGrandTotal();
        const payment = parseFloat(document.getElementById("payment")?.value) || 0;
        const change = payment - grandTotal;
        const changeBox = document.getElementById("changeBox");
        const changeElement = document.getElementById("change");

        if (!changeBox || !changeElement) return;

        if (change >= 0) {
            changeBox.classList.remove("short-payment");
            changeElement.innerText = formatRupiah(change);
            document.querySelector(".change-label").innerText = "KEMBALIAN";
        } else {
            changeBox.classList.add("short-payment");
            changeElement.innerText = formatRupiah(Math.abs(change));
            document.querySelector(".change-label").innerText = "UANG KURANG";
        }
    }

    /* --------------------------------------------------
       4. NOMINAL CEPAT & METHOD SELECTION
    -------------------------------------------------- */
    function setQuickCash(amount) {
        document.getElementById("payment").value = amount;
        calculateChange();
    }

    function setExactCash() {
        document.getElementById("payment").value = getGrandTotal();
        calculateChange();
    }

    function selectPayment(button) {
        document.querySelectorAll(".payment-method button").forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");
    }

    /* --------------------------------------------------
       5. PROSES PEMBAYARAN KE CONTROLLER (FETCH API)
    -------------------------------------------------- */
    function processPayment() {
        if (cart.length === 0) {
            alert("Keranjang masih kosong.");
            return;
        }

        const total = getGrandTotal();
        const payment = parseFloat(document.getElementById("payment")?.value) || 0;

        if (payment < total) {
            alert("Uang pembayaran kurang!");
            return;
        }

        const activePaymentBtn = document.querySelector(".payment-method button.active");
        const paymentMethod = activePaymentBtn ? activePaymentBtn.innerText : "Tunai";
        const discountPercent = parseFloat(document.getElementById("discountPercent")?.value) || 0;
        const manualDiscount = parseFloat(document.getElementById("discountAmount")?.value) || 0;
        const tax = parseFloat(document.getElementById("tax")?.value) || 0;
        const otherFee = parseFloat(document.getElementById("otherFee")?.value) || 0;

        let subtotal = 0;
        cart.forEach(item => subtotal += item.price * item.qty);
        const totalDiscount = (subtotal * discountPercent / 100) + manualDiscount;

        // Nonaktifkan tombol sementara
        const btnPay = document.getElementById("btnPay");
        if (btnPay) {
            btnPay.disabled = true;
            btnPay.innerText = "MEMPROSES...";
        }

        // Payload data transaksi ke Laravel KasirController
        const payload = {
            cart: cart,
            customer_id: document.getElementById("customerSelect")?.value || null,
            subtotal: subtotal,
            discount: totalDiscount,
            tax: tax,
            other_fee: otherFee,
            grand_total: total,
            paid_amount: payment,
            change_amount: payment - total,
            payment_method: paymentMethod
        };

        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // FETCH POST KE LARAVEL
        fetch("{{ route('kasir.store') }}", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": token,
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(payload)
        })
        .then(async (response) => {
            const contentType = response.headers.get("content-type") || "";
            const data = contentType.includes("application/json") ? await response.json() : null;

            if (response.status === 401 || response.status === 419) {
                window.location.href = "{{ route('login') }}";
                return null;
            }

            if (!response.ok) {
                throw new Error((data && data.message) || "Terjadi kesalahan server");
            }

            return data;
        })
        .then((data) => {
            if (!data) return;

            if (data.success) {
                alert(data.message || "Transaksi berhasil disimpan!");
                
                // 1. ISI STRUK TERLEBIH DAHULU LALU TAMPILKAN POP-UP CETAK
                printReceipt(payment, total);

                if (data.invoice_url) {
                    const previewLink = document.getElementById('invoicePreviewLink');
                    const invoiceActions = document.getElementById('invoiceActions');
                    lastInvoiceUrl = data.invoice_url;

                    if (previewLink) previewLink.href = data.invoice_url;
                    if (invoiceActions) invoiceActions.classList.remove('d-none');

                    window.open(data.invoice_url, '_blank', 'noopener,noreferrer');
                }

                // 2. BERSIHKAN KERANJANG
                cancelTransaction(false);
            } else {
                alert("Gagal: " + (data.message || "Terjadi kesalahan"));
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error menyimpan transaksi: " + error.message);
        })
        .finally(() => {
            if (btnPay) {
                btnPay.disabled = false;
                btnPay.innerText = "BAYAR & CETAK";
            }
        });
    }

    /* --------------------------------------------------
       FUNGSI KHUSUS MENGISI DATA & CETAK STRUK THERMAL
    -------------------------------------------------- */
    function printReceipt(payment, total) {
        const printArea = document.getElementById("receipt-print-area");
        if (!printArea) return;

        // Set Tanggal Transaksi
        const printDate = document.getElementById("printDate");
        if (printDate) printDate.innerText = new Date().toLocaleString("id-ID");

        // Format Rincian Item Keranjang
        let printBody = "";
        cart.forEach((item) => {
            printBody += `
                <tr>
                    <td colspan="2" style="font-weight:bold;">${item.name}</td>
                </tr>
                <tr>
                    <td>${item.qty} x ${formatRupiah(item.price)}</td>
                    <td style="text-align:right;">${formatRupiah(item.price * item.qty)}</td>
                </tr>
            `;
        });

        const printCartItems = document.getElementById("printCartItems");
        if (printCartItems) printCartItems.innerHTML = printBody;

        // Fill Subtotal, Total, Bayar, Kembalian
        if (document.getElementById("printGrandTotal")) document.getElementById("printGrandTotal").innerText = formatRupiah(total);
        if (document.getElementById("printPaid")) document.getElementById("printPaid").innerText = formatRupiah(payment);
        if (document.getElementById("printChange")) document.getElementById("printChange").innerText = formatRupiah(payment - total);

        // Tampilkan sementara, pemicu dialog cetak, lalu sembunyikan kembali
        printArea.style.display = "block";
        window.print();
        printArea.style.display = "none";
    }

    function printLastInvoice() {
        if (!lastInvoiceUrl) {
            alert('Belum ada invoice yang diproses.');
            return;
        }

        const printWindow = window.open(lastInvoiceUrl, '_blank', 'noopener,noreferrer');
        if (printWindow) {
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
            }, 500);
        }
    }

    /* --------------------------------------------------
       6. HOLD & CANCEL TRANSAKSI
    -------------------------------------------------- */
    function holdTransaction() {
        if (cart.length === 0) {
            alert("Tidak ada barang di keranjang untuk ditahan.");
            return;
        }

        const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        const totalAmount = getGrandTotal();

        heldTransactions.push({
            trxNo: "HOLD-" + (heldTransactions.length + 1),
            cartData: [...cart],
            totalItems: totalItems,
            totalAmount: totalAmount
        });

        cart = [];
        renderCart();
        renderHoldTable();
        alert("Transaksi berhasil ditahan.");
    }

    function renderHoldTable() {
        const holdBody = document.getElementById("holdTableBody");
        const holdCount = document.getElementById("holdCount");
        if (holdCount) holdCount.innerText = heldTransactions.length;

        if (!holdBody) return;

        if (heldTransactions.length === 0) {
            holdBody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">Tidak ada transaksi yang ditahan.</td></tr>`;
            return;
        }

        holdBody.innerHTML = heldTransactions.map((item, index) => `
            <tr>
                <td>${index + 1}</td>
                <td><strong>${item.trxNo}</strong></td>
                <td>${item.totalItems} Item</td>
                <td>${formatRupiah(item.totalAmount)}</td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="resumeTransaction(${index})">Lanjutkan</button>
                </td>
            </tr>
        `).join("");
    }

    function resumeTransaction(index) {
        if (cart.length > 0) {
            if (!confirm("Keranjang saat ini tidak kosong. Ganti dengan transaksi yang ditahan?")) return;
        }

        cart = [...heldTransactions[index].cartData];
        heldTransactions.splice(index, 1);
        renderHoldTable();
        renderCart();

        const holdModalEl = document.getElementById('holdModal');
        if (holdModalEl && typeof bootstrap !== 'undefined') {
            const holdModal = bootstrap.Modal.getInstance(holdModalEl);
            if (holdModal) holdModal.hide();
        }
    }

    function cancelTransaction(confirmReq = true) {
        if (confirmReq && cart.length > 0 && !confirm("Batalkan transaksi ini?")) return;

        cart = [];
        if (document.getElementById("payment")) document.getElementById("payment").value = "";
        if (document.getElementById("discountPercent")) document.getElementById("discountPercent").value = 0;
        if (document.getElementById("discountAmount")) document.getElementById("discountAmount").value = 0;
        if (document.getElementById("tax")) document.getElementById("tax").value = 0;
        if (document.getElementById("otherFee")) document.getElementById("otherFee").value = 0;

        renderCart();
    }

    /* --------------------------------------------------
       7. INITIALIZATION & KEYBOARD SHORTCUTS
    -------------------------------------------------- */
    if (document.getElementById("currentDate")) {
        document.getElementById("currentDate").innerText = new Date().toLocaleString("id-ID");
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "F2") {
            event.preventDefault();
            if (searchInput) searchInput.focus();
        }
        if (event.key === "F4") {
            event.preventDefault();
            if (document.getElementById("payment")) document.getElementById("payment").focus();
        }
        if (event.key === "Escape") {
            cancelTransaction();
        }
    });

    // Inisialisasi awal keranjang
    renderCart();
</script>
</body>
</html>