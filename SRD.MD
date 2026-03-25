1. Giới thiệu (Introduction)
Mục đích: Tài liệu này cung cấp cái nhìn chi tiết về các chức năng và yêu cầu kỹ thuật cho hệ thống website bán đồ thể thao.

Phạm vi: Hệ thống bao gồm trang web cho khách hàng mua sắm và trang quản trị (Admin) để quản lý cửa hàng.

2. Mô tả tổng quan (Overall Description)
Chân dung người dùng:

Khách hàng: Người dùng có nhu cầu mua sắm quần áo, dụng cụ thể thao trực tuyến.

Quản trị viên (Admin): Nhân viên cửa hàng quản lý nội dung, sản phẩm và đơn hàng.

Công nghệ triển khai: PHP (mysqli), MySQL, Bootstrap 4, jQuery.

3. Yêu cầu chức năng (Functional Requirements)
3.1. Phân hệ Quản trị (Admin)
Đăng nhập hệ thống (Mã: F-ADM-01):

Hệ thống cho phép Admin đăng nhập bằng tài khoản và mật khẩu đã mã hóa MD5.

Kiểm tra tính hợp lệ và chuyển hướng đến trang index.php nếu thành công.

Hiển thị thông báo lỗi nếu thông tin sai.

Quản lý sản phẩm (Mã: F-ADM-02):

Thêm, sửa, xóa thông tin đồ thể thao (giá, số lượng, size, màu sắc).

Quản lý danh mục (Mã: F-ADM-03):

Phân loại sản phẩm theo bộ môn: Bóng đá, Cầu lông, Gym, Chạy bộ.

Quản lý đơn hàng (Mã: F-ADM-04):

Xem danh sách đơn hàng và cập nhật trạng thái (Chờ duyệt, Đang giao, Đã giao).

3.2. Phân hệ Người dùng (User)
Duyệt và Tìm kiếm (Mã: F-USR-01):

Tìm kiếm đồ thể thao theo tên, thương hiệu hoặc bộ môn.

Giỏ hàng (Mã: F-USR-02):

Thêm/bớt sản phẩm, cập nhật số lượng trong giỏ hàng.

Thanh toán trực tuyến (Mã: F-USR-03):

Tích hợp thanh toán qua VNPay, MoMo hoặc ZaloPay.

Lịch sử mua hàng (Mã: F-USR-04):

Người dùng đăng nhập có thể xem lại các đơn hàng thể thao đã đặt.

4. Yêu cầu phi chức năng (Non-functional Requirements)
Bảo mật: Mật khẩu phải được mã hóa trước khi lưu xuống cơ sở dữ liệu.

Hiệu năng: Thời gian phản hồi trang web không quá 2 giây.

Giao diện (UI): Sử dụng Bootstrap để đảm bảo hiển thị tốt trên cả máy tính và thiết bị di động.
