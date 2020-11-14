-- user account

INSERT INTO user_account (account_id, email, name, name_url, phone) VALUES (1, 'my.name@mydomain.com', 'My Name', 'my-name', '223-393-8373');

-- store account

INSERT INTO store_account (account_id, title, title_url) VALUES (9883, 'Safeway', 'safeway');
INSERT INTO store_account (account_id, title, title_url) VALUES (233, 'Lucky', 'lucky');
INSERT INTO store_account (account_id, title, title_url) VALUES (382, 'CVS', 'cvs');

-- store

INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (971, 134, 'Safeway City Street', 'safeway-city-street', 'safeway');
INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (98, 46, 'Lucky City Street', 'lucky-city-street', 'lucky');
INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (325, 13, 'CVS City Street', 'cvs-city-street', 'cvs');

-- category

INSERT INTO category (title, title_url) VALUES ('Test Category 1', 'test-category-1');
INSERT INTO category (title, title_url) VALUES ('Test Category 2', 'test-category-2');
INSERT INTO category (title, title_url) VALUES ('Test Category 3', 'test-category-3');
