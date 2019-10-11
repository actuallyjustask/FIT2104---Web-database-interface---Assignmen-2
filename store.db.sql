create table admin
(
    id       int auto_increment
        primary key,
    Username varchar(50)  null,
    Password varchar(255) not null
);

create table category
(
    ID   int auto_increment
        primary key,
    Name varchar(100) not null
);

create table client
(
    ID          int auto_increment
        primary key,
    Fname       varchar(50)  not null,
    Lname       varchar(50)  not null,
    Street      varchar(100) null,
    Suburb      varchar(50)  null,
    State       varchar(6)   null,
    Postcode    varchar(4)   null,
    Email       varchar(50)  not null,
    Mobile      varchar(12)  null,
    Mailinglist char         null
);

create table product
(
    ID                int auto_increment
        primary key,
    Name              varchar(30)   not null,
    Purchase_Price    decimal(6, 2) null,
    Sale_Price        decimal(6, 2) null,
    Country_of_Origin varchar(40)   null
);

create table product_category
(
    Product_id  int not null,
    Category_id int not null,
    primary key (Product_id, Category_id),
    constraint product_category_Category_fk
        foreign key (Category_id) references category (ID),
    constraint product_category_Product_fk
        foreign key (Product_id) references product (ID)
);

create table product_image
(
    ID         int auto_increment
        primary key,
    Product_id int          null,
    Name       varchar(255) not null,
    constraint Product_Image_fk
        foreign key (Product_id) references product (ID)
);

create table project
(
    ID          int auto_increment
        primary key,
    Description varchar(100) not null,
    Country     varchar(50)  null,
    City        varchar(50)  null
);

