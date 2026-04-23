# SRS - Chuc Nang Quan Ly San Pham (PIM)

## 1. Muc tieu
Tai lieu nay mo ta boi canh nghiep vu va quy trinh lien quan den chuc nang Quan ly San pham (PIM) trong he thong website ban thiet bi nganh anh cua Kochi Lens.

## 2. Pham vi
Chuc nang PIM cho phep doanh nghiep quan ly thong tin san pham, bien the san pham, ton kho hien thi realtime, va cung cap du lieu chinh xac cho khach hang, bo phan kho va bo phan ke toan.

## 3. Actor
- Admin: Quan ly thong tin san pham, gia ban, bien the va trang thai kinh doanh.
- Customer: Xem san pham, bien the, gia va ton kho truoc khi dat hang.
- Warehouse Staff: Theo doi ton kho va xac nhan tinh san sang cua san pham khi xu ly don.

## 4. Use Case Diagram
```mermaid
flowchart LR
    Admin[Admin]
    Customer[Customer]
    Warehouse[Warehouse Staff]

    UC1((Tao san pham))
    UC2((Cap nhat san pham))
    UC3((Quan ly bien the))
    UC4((Quan ly ton kho))
    UC5((Xem san pham va ton kho))
    UC6((Kiem tra tinh san sang de dong goi))

    Admin --> UC1
    Admin --> UC2
    Admin --> UC3
    Admin --> UC4
    Customer --> UC5
    Warehouse --> UC6
    Warehouse --> UC4
```

## 5. Activity Diagram - Luong dat hang tu chon san pham den thanh toan thanh cong
```mermaid
flowchart TD
    A[Khach hang truy cap website] --> B[Xem danh sach san pham]
    B --> C[Chon san pham va bien the]
    C --> D{Con hang khong?}
    D -- Khong --> E[Thong bao het hang]
    D -- Co --> F[Them vao gio hang]
    F --> G[Nhap thong tin giao hang]
    G --> H[He thong tinh tam tinh, VAT, phi ship]
    H --> I[Khach chon phuong thuc thanh toan]
    I --> J[Thanh toan VNPay/Momo]
    J --> K{Thanh toan thanh cong?}
    K -- Khong --> L[Thong bao that bai va cho thanh toan lai]
    K -- Co --> M[Tao don hang]
    M --> N[Cap nhat ton kho]
    N --> O[Gui don hang ve BackEnd]
    O --> P[Kho dong goi]
    O --> Q[Ke toan xuat hoa don]
```

## 6. Mo ta nghiep vu
- Admin quan ly tap trung danh muc san pham va bien the de dam bao thong tin nhat quan tren toan he thong.
- Ton kho can duoc cap nhat kip thoi sau khi co don hang thanh cong de tranh ban vuot ton.
- Warehouse Staff can nhin thay trang thai ton kho thuc te de xu ly dong goi.
- Thong tin san pham va ton kho phai duoc dong bo giua giao dien khach hang va BackEnd.
