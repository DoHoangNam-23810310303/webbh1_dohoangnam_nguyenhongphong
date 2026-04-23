# SRS - Functional Requirements Cho PIM

## 1. Tong quan
Phan nay dac ta cac yeu cau chuc nang cho PIM duoi dang User Story.

## 2. User Stories

### 2.1 Quan ly thong tin san pham
- La mot Admin, toi muon tao moi san pham voi ten, SKU, barcode, mo ta, gia ban va thue VAT de san pham co the duoc ban tren website.
- La mot Admin, toi muon cap nhat thong tin san pham de dam bao noi dung hien thi luon chinh xac.
- La mot Admin, toi muon an/ngung kinh doanh mot san pham de khach hang khong dat nham san pham khong con ban.

### 2.2 Quan ly bien the
- La mot Admin, toi muon tao bien the theo mau sac va kich thuoc de quan ly tung loai san pham chi tiet.
- La mot Admin, toi muon dat SKU rieng cho tung bien the de de theo doi ton kho va giao nhan.
- La mot Customer, toi muon chon dung bien the san pham de dat mua dung nhu cau.

### 2.3 Quan ly ton kho realtime
- La mot Admin, toi muon xem ton kho cua tung san pham va bien the de dua ra quyet dinh nhap hang va kinh doanh.
- La mot Warehouse Staff, toi muon cap nhat so luong ton kho sau khi dong goi hoac xu ly don de du lieu ton kho luon dung.
- La mot Customer, toi muon thay trang thai con hang/het hang theo thoi gian thuc de biet san pham co the mua duoc hay khong.

### 2.4 Tich hop voi quy trinh dat hang
- La mot Customer, toi muon he thong tu dong kiem tra ton kho truoc khi them vao gio hang de tranh dat san pham het hang.
- La mot Admin, toi muon ton kho giam tu dong sau khi thanh toan thanh cong de du lieu BackEnd chinh xac.
- La mot Warehouse Staff, toi muon nhan thong tin san pham trong don hang de chuan bi dong goi nhanh va dung.

### 2.5 Kiem soat du lieu
- La mot Admin, toi muon he thong canh bao khi SKU bi trung de tranh nham lan giua cac san pham.
- La mot Admin, toi muon cac truong gia ban, thue VAT va barcode duoc kiem tra hop le de dam bao chat luong du lieu.
- La mot Admin, toi muon luu lich su cap nhat san pham de co the kiem tra khi co sai lech thong tin.

## 3. Functional Requirements Chi tiet

### FR-01 Tao san pham
He thong phai cho phep Admin tao san pham moi voi day du thong tin bat buoc.

### FR-02 Cap nhat san pham
He thong phai cho phep Admin sua thong tin san pham da ton tai.

### FR-03 Quan ly bien the
He thong phai cho phep Admin tao, sua va quan ly bien the theo mau sac, kich thuoc.

### FR-04 Hien thi ton kho realtime
He thong phai cap nhat va hien thi ton kho theo thoi gian thuc hoac gan thoi gian thuc.

### FR-05 Dong bo ton kho voi don hang
He thong phai tru ton kho khi don hang thanh toan thanh cong.

### FR-06 Kiem tra hop le du lieu
He thong phai kiem tra SKU duy nhat, gia ban hop le, VAT hop le va bien the hop le truoc khi luu.
