-- user account

INSERT INTO user_account (account_id, email, name, name_url, phone) VALUES (1, 'my.name@mydomain.com', 'My Name', 'my-name', '223-393-8373');

-- store account

INSERT INTO store_account (account_id, title, title_url) VALUES (9883, 'Store Account 1', 'store-account-1');
INSERT INTO store_account (account_id, title, title_url) VALUES (233, 'Store Account 2', 'store-account-2');
INSERT INTO store_account (account_id, title, title_url) VALUES (382, 'Store Account 3', 'store-account-3');
INSERT INTO store_account (account_id, title, title_url) VALUES (482, 'My Account', 'my-account');

-- store

INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (971, 134, 'Store 1 City Street', 'store-1-city-street', 'store-account-1');
INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (98, 46, 'Store 2 City Street', 'store-2-city-street', 'store-account-2');
INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (325, 13, 'Store 3 City Street', 'store-3-city-street', 'store-account-3');
INSERT INTO store (store_id, store_number, title, title_url, store_account_title_url) VALUES (125, 10, 'My Store', 'my-store', 'my-account');

-- category

INSERT INTO category (title, title_url) VALUES ('Test Category 1', 'test-category-1');
INSERT INTO category (title, title_url) VALUES ('Test Category 2', 'test-category-2');
INSERT INTO category (title, title_url) VALUES ('Test Category 3', 'test-category-3');
