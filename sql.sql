CREATE TABLE chuyenmuc(
	chuyenmuc_id INT AUTO_INCREMENT, 
    tenchuyenmuc TEXT NOT NULL, 
    motachuyenmuc TEXT NOT NULL,
    CONSTRAINT pk_chuyenmuc PRIMARY KEY (chuyenmuc_id)
)


CREATE TABLE thanhvien (
	thanhvien_id INT AUTO_INCREMENT, 
    tenthanhvien TEXT NOT NULL, 
    email TEXT NOT NULL, 
    matkhau varchar(45) NOT NULL, 
    
    
    ngaysinh date, 
    gioitinh bit, 
    diachi text, 
    
    CONSTRAINT pk_thanhvien PRIMARY key (thanhvien_id)
)

CREATE TABLE baiviet( baiviet_id int AUTO_INCREMENT, tieudebaiviet TEXT NOT NULL, noidungbaiviet TEXT NOT NULL, thanhvien_id INT, chuyenmuc_id INT, CONSTRAINT pk_baiviet PRIMARY key (baiviet_id), CONSTRAINT fk_baiviet_thanhvien_id FOREIGN KEY (thanhvien_id) REFERENCES thanhvien(thanhvien_id), CONSTRAINT fk_baiviet_chuyenmuc_id FOREIGN KEY (chuyenmuc_id) REFER#32E31BFFENCES chuyenmuc(chuyenmuc_id) )


CREATE TABLE binhluan(
	binhluan_id int AUTO_INCREMENT, 
    noidungbinhluan TEXT NOT NULL, 
    ngaybinhluan date not null, 
    
    baiviet_id int, 
    thanhvien_id int, 
    
    constraint pk_binhluan PRIMARY KEY (binhluan_id), 
    CONSTRAINT fk_binhluan_baiviet_id FOREIGN KEY (baiviet_id) REFERENCES baiviet (baiviet_id), 
    CONSTRAINT fk_binhluan_thanhvien_id FOREIGN KEY (thanhvien_id) REFERENCES thanhvien(thanhvien_id)
    
)

ALTER TABLE baiviet ADD ngaydang date not null;


CREATE TABLE tamtrang( tamtrang_id INT AUTO_INCREMENT, noidung text not null, ngaydang date not null, giodang time not null, linkdinhkem text, hinhdinhkem text, filedinhkem text, thanhvien_id int, 
    CONSTRAINT pk_tamtrang PRIMARY KEY (tamtrang_id), 
    CONSTRAINT fk_tamtrang_thanhvien FOREIGN KEY (thanhvien_id) REFERENCES thanhvien(thanhvien_id) )



CREATE TABLE camsuccs(
    camsuccs_id int AUTO_INCREMENT, 
    noidungcamsuc text not null, 
    tamtrang_id int, 
    thanhvien_id int, 
    CONSTRAINT pk_camsuccs PRIMARY KEY(camsuccs_id), 
    CONSTRAINT fk_camsuccs_tamtrang FOREIGN KEY (tamtrang_id) REFERENCES tamtrang(tamtrang_id), 
    CONSTRAINT fk_camsuccs_thanhvien FOREIGN KEY (thanhvien_id) REFERENCES thanhvien(thanhvien_id)
)

CREATE TABLE hinhdinhkem(
    hinhdinhkem_id int AUTO_INCREMENT, 
    duongdan text not null, 
    CONSTRAINT pk_hinhanhdinhkem PRIMARY KEY (hinhdinhkem_id)
)


ALTER TABLE `tamtrang` CHANGE `hinhdinhkem` `hinhdinhkem_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;