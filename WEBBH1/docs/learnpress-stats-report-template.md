# Bao cao bai thuc hanh LearnPress - mau noi dung

## 1. Thong tin de tai

- De tai: He thong quan ly hoc tap (LMS) voi LearnPress
- Ngay thuc hanh: 30/03/2026
- Plugin tu phat trien: LearnPress Stats Dashboard

## 2. Phan 1 - Cai dat va cau hinh LearnPress

### 2.1 Cai dat plugin

- Dang nhap vao trang quan tri WordPress.
- Chon `Plugins > Add New`.
- Tim `LearnPress`.
- Nhan `Install Now` va `Activate`.

### 2.2 Tao du lieu mau

- Tao 2 khoa hoc bat ky.
- Moi khoa hoc co:
  - 2 bai hoc.
  - 1 bai kiem tra.
- Cau hinh hoc phi:
  - 1 khoa hoc mien phi.
  - 1 khoa hoc co gia.
- Tao 1 tai khoan hoc vien gia lap va dang ky hoc thu.

### 2.3 Anh chup man hinh can bo sung

- Man hinh plugin LearnPress da kich hoat.
- Danh sach 2 khoa hoc da tao.
- Cau truc lesson/quiz ben trong tung khoa hoc.
- Tai khoan hoc vien dang ky vao khoa hoc.

## 3. Phan 2 - Plugin LearnPress Stats Dashboard

### 3.1 Cau truc plugin

```text
lp-stats-addon/
|-- assets/
|   `-- lp-stats-addon.css
|-- includes/
|   `-- class-lp-stats-addon.php
`-- lp-stats-addon.php
```

### 3.2 Chuc nang da thuc hien

- Tao plugin rieng, khong sua truc tiep vao LearnPress.
- Tao Dashboard Widget trong Admin.
- Tao shortcode `[lp_total_stats]`.
- Truy van thong ke bang LearnPress / `$wpdb`.

### 3.3 Giai thich doan code quan trong

#### Ham lay tong so hoc vien

Plugin doc bang `wp_learnpress_user_items` va dem so `user_id` khac nhau voi dieu kien `item_type = 'lp_course'`. Cach nay cho biet co bao nhieu hoc vien da dang ky vao it nhat mot khoa hoc.

#### Ham lay so khoa hoc hoan thanh

Plugin truy van bang `wp_learnpress_user_items` voi dieu kien `status = 'completed'` va `item_type = 'lp_course'`. Moi ban ghi the hien mot lan hoan thanh khoa hoc cua hoc vien.

#### Dashboard Widget va Shortcode

- Dashboard Widget duoc dang ky bang `wp_add_dashboard_widget`.
- Shortcode duoc dang ky bang `add_shortcode('lp_total_stats', ...)`.
- Ca hai deu dung chung mot ham render de tranh lap code.

### 3.4 Anh chup man hinh can bo sung

- Thu muc plugin trong `wp-content/plugins`.
- Plugin da duoc kich hoat.
- Dashboard Widget hien thi 3 thong so.
- Frontend hien thi shortcode `[lp_total_stats]`.

## 4. Ket luan

Plugin da hoan thanh yeu cau thong ke co ban cho LearnPress, giup Admin xem nhanh tinh hinh khoa hoc va hoc vien ngay tren Dashboard hoac ngoai trang chu thong qua shortcode.
