# LearnPress Stats Dashboard

Plugin nay duoc viet rieng cho bai thuc hanh LearnPress ngay 30/03/2026.

## Tinh nang

- Tao dashboard widget trong trang quan tri WordPress.
- Tao shortcode `[lp_total_stats]` de hien thi thong ke ngoai frontend.
- Thong ke 3 chi so:
  - Tong so khoa hoc.
  - Tong so hoc vien da dang ky.
  - So luong khoa hoc da hoan thanh.

## Cai dat plugin

1. Chep thu muc `lp-stats-addon` vao `wp-content/plugins/`.
2. Vao `Plugins` trong WordPress va kich hoat `LearnPress Stats Dashboard`.
3. Vao `Dashboard` de xem widget.
4. Tao mot trang bat ky, chen shortcode `[lp_total_stats]` de hien thi ngoai frontend.

## Goi y phan 1 bai thuc hanh

1. Cai plugin `LearnPress` tu thu vien WordPress.org.
2. Tao it nhat 2 course.
3. Moi course tao it nhat 2 lesson va 1 quiz.
4. Dat 1 khoa hoc mien phi, 1 khoa hoc co gia tuy chon.
5. Tao tai khoan hoc vien gia lap va dang ky hoc thu.
6. Hoan thanh it nhat 1 course de plugin co du lieu `completed`.

## Giai thich ky thuat

- Plugin uu tien doc bang `wp_learnpress_user_items` neu co san, vi day la noi LearnPress luu quan he hoc vien - khoa hoc va trang thai hoan thanh.
- Neu bang LearnPress chua ton tai, plugin fallback sang thong tin co ban tu `wp_posts` de tranh gay loi.
- Ham thong ke hoc vien dem `DISTINCT user_id` voi `item_type = 'lp_course'`.
- Ham thong ke khoa hoc hoan thanh dem ban ghi co `status = 'completed'`.
