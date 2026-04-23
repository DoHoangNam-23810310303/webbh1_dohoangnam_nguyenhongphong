# SRS - Data Schema Cho PIM

## 1. Tong quan
Phan nay liet ke cac truong du lieu quan trong lien quan den Partner, Product va Order trong he thong Kochi Lens.

## 2. Partner (Khach hang)
| Truong | Kieu du lieu de xuat | Bat buoc | Mo ta |
|---|---|---|---|
| partner_id | INT | Co | Ma dinh danh khach hang |
| ten_khach_hang | VARCHAR(255) | Co | Ho ten ca nhan hoac ten cong ty |
| loai_khach_hang | ENUM(Guest, B2C, B2B) | Co | Phan biet khach vang lai va khach thanh vien |
| ma_so_thue | VARCHAR(50) | Khong | MST neu la cong ty |
| email | VARCHAR(255) | Co | Email lien he va dang nhap |
| so_dien_thoai | VARCHAR(20) | Co | So dien thoai lien he |
| dia_chi_giao_hang | TEXT | Co | Dia chi nhan hang |
| dia_chi_xuat_hoa_don | TEXT | Khong | Dia chi tren hoa don |
| created_at | DATETIME | Co | Ngay tao khach hang |
| updated_at | DATETIME | Co | Ngay cap nhat gan nhat |

## 3. Product
| Truong | Kieu du lieu de xuat | Bat buoc | Mo ta |
|---|---|---|---|
| product_id | INT | Co | Ma san pham |
| ten_san_pham | VARCHAR(255) | Co | Ten hien thi san pham |
| sku | VARCHAR(100) | Co | Ma SKU duy nhat |
| barcode | VARCHAR(100) | Co | Ma vach san pham |
| mo_ta_ngan | TEXT | Khong | Mo ta tom tat |
| mo_ta_chi_tiet | TEXT | Khong | Mo ta chi tiet |
| gia_ban | DECIMAL(15,2) | Co | Gia ban niem yet |
| thue_vat | DECIMAL(5,2) | Co | Ty le VAT ap dung |
| trang_thai | ENUM(Active, Inactive) | Co | Trang thai kinh doanh |
| ton_kho_hien_tai | INT | Co | So luong ton kho hien tai |
| hinh_anh | VARCHAR(255) | Khong | Duong dan anh san pham |
| created_at | DATETIME | Co | Ngay tao san pham |
| updated_at | DATETIME | Co | Ngay cap nhat gan nhat |

## 4. Product Variant
| Truong | Kieu du lieu de xuat | Bat buoc | Mo ta |
|---|---|---|---|
| variant_id | INT | Co | Ma bien the |
| product_id | INT | Co | Khoa ngoai toi Product |
| variant_sku | VARCHAR(100) | Co | SKU rieng cho bien the |
| mau_sac | VARCHAR(100) | Khong | Mau sac cua bien the |
| kich_thuoc | VARCHAR(100) | Khong | Kich thuoc cua bien the |
| ton_kho_bien_the | INT | Co | So luong ton theo bien the |
| gia_dieu_chinh | DECIMAL(15,2) | Khong | Gia chenh lech neu co |
| trang_thai | ENUM(Active, Inactive) | Co | Trang thai bien the |

## 5. Order
| Truong | Kieu du lieu de xuat | Bat buoc | Mo ta |
|---|---|---|---|
| order_id | INT | Co | Ma don hang noi bo |
| so_don_hang | VARCHAR(100) | Co | So don hang hien thi |
| partner_id | INT | Co | Khoa ngoai toi Partner |
| trang_thai | ENUM(Draft, Confirmed, Cancelled) | Co | Trang thai don hang |
| tong_tien_hang | DECIMAL(15,2) | Co | Tong tien truoc thue va phi ship |
| thue_vat | DECIMAL(15,2) | Co | Tong tien thue VAT |
| phi_van_chuyen | DECIMAL(15,2) | Co | Phi ship |
| tong_thanh_toan | DECIMAL(15,2) | Co | Tong thanh toan cuoi cung |
| cong_thanh_toan | ENUM(VNPay, Momo, COD) | Khong | Kenh thanh toan |
| payment_status | ENUM(Pending, Paid, Failed) | Co | Trang thai thanh toan |
| created_at | DATETIME | Co | Ngay tao don |
| updated_at | DATETIME | Co | Ngay cap nhat don |

## 6. Ghi chu thiet ke
- SKU va Barcode phai duoc dam bao tinh duy nhat.
- Ton kho can duoc cap nhat sau moi giao dich thanh cong.
- Don hang can luu duoc trang thai Draft -> Confirmed -> Delivery -> Invoice de phuc vu quy trinh OMS.
- Du lieu Product, Variant va Order phai co lien ket de truy vet san pham da ban.
