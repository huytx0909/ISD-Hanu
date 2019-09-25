# ISD-Hanu
School Project

Huy:
validate password(ít nhất là cũng phải trên 8 kí tự có chữ số), hash pasword, ko hiện password trên admin user
-validate username(add hay edit ko bị trùng với username đã có, username phải unique)
-validate phone (10 số)
-validate salary(only number, cái này attribute của salary t đổi thành varchar rồi để ghi đc 3,000,000. có dấu phẩy các thứ)
validate fullName(cái này mới thêm cho đầy đủ, only letter and space, cái này t validate rồi :)) )

Hai:
đồng bộ thông báo add, edit, delete thành công các thứ như nào cũng đc miền là đồng bộ
add, edit xong rồi có 2 phương án làm. 1 là thông báo rồi ko redirect về đâu cả và tạo 1 nút back về trang trước, 2 là redirect về đúng trang trước khi ấn vào add với edit (có 1 số trang tôi làm lồng vào nhau nên redirect hơi khó đấy vì chỉ có 1 trang add mà đôi khi có 2 trang có thể redirect dc về)
đồng bộ thông báo lỗi đẹp đẹp, ít nhất là phải đồng bộ tất cả các trang phải giống nhau

- Add cancel button.
- Add go back button.
- Remake/Synchronize Addbook/addteam pages
