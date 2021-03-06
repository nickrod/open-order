-- functions

-- account

CREATE OR REPLACE FUNCTION account()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'user_account') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_user_account = total_user_account + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_user_account = total_user_account - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'store_account') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_store_account = total_store_account + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_store_account = total_store_account - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- tag

CREATE OR REPLACE FUNCTION tag()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'currency') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_currency = total_currency + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_currency = total_currency - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'category') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_category = total_category + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_category = total_category - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- item

CREATE OR REPLACE FUNCTION item()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'sales_item') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_sales_item = total_sales_item + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_sales_item = total_sales_item - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'sales_order') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_sales_order = total_sales_order + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_sales_order = total_sales_order - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      IF (NEW.shipping_price IS NOT NULL OR OLD.shipping_price IS NOT NULL) THEN
        IF (NEW.shipping_price IS NULL AND OLD.shipping_price IS NOT NULL) THEN
          NEW.total_price = OLD.total_price - OLD.shipping_price;
        ELSIF (NEW.shipping_price IS NOT NULL AND OLD.shipping_price IS NULL) THEN
          NEW.total_price = OLD.total_price + NEW.shipping_price;
        ELSIF (NEW.shipping_price != OLD.shipping_price) THEN
          NEW.total_price = OLD.total_price + (NEW.shipping_price - OLD.shipping_price);
        END IF;
      END IF;
      IF (NEW.tax_price IS NOT NULL OR OLD.tax_price IS NOT NULL) THEN
        IF (NEW.tax_price IS NULL AND OLD.tax_price IS NOT NULL) THEN
          NEW.total_price = OLD.total_price - OLD.tax_price;
        ELSIF (NEW.tax_price IS NOT NULL AND OLD.tax_price IS NULL) THEN
          NEW.total_price = OLD.total_price + NEW.tax_price;
        ELSIF (NEW.tax_price != OLD.tax_price) THEN
          NEW.total_price = OLD.total_price + (NEW.tax_price - OLD.tax_price);
        END IF;
      END IF;
      IF (NEW.subtotal_price IS NOT NULL OR OLD.subtotal_price IS NOT NULL) THEN
        IF (NEW.subtotal_price IS NULL AND OLD.subtotal_price IS NOT NULL) THEN
          NEW.total_price = OLD.total_price - OLD.subtotal_price;
        ELSIF (NEW.subtotal_price IS NOT NULL AND OLD.subtotal_price IS NULL) THEN
          NEW.total_price = OLD.total_price + NEW.subtotal_price;
        ELSIF (NEW.subtotal_price != OLD.subtotal_price) THEN
          NEW.total_price = OLD.total_price + (NEW.subtotal_price - OLD.subtotal_price);
        END IF;
      END IF;
      IF (NEW.discount_price IS NOT NULL OR OLD.discount_price IS NOT NULL) THEN
        IF (NEW.discount_price IS NULL AND OLD.discount_price IS NOT NULL) THEN
          NEW.total_price = OLD.total_price + OLD.discount_price;
        ELSIF (NEW.discount_price IS NOT NULL AND OLD.discount_price IS NULL) THEN
          NEW.total_price = OLD.total_price - NEW.discount_price;
        ELSIF (NEW.discount_price != OLD.discount_price) THEN
          NEW.total_price = OLD.total_price - (NEW.discount_price - OLD.discount_price);
        END IF;
      END IF;
      NEW.updated_date := NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'store_account') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_store_account = total_store_account + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_store_account = total_store_account - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'store') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_store = total_store + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_store = total_store - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date := NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- triggers

-- account

DROP TRIGGER IF EXISTS user_account_insert ON user_account;
DROP TRIGGER IF EXISTS user_account_delete ON user_account;
DROP TRIGGER IF EXISTS user_account_update ON user_account;
DROP TRIGGER IF EXISTS store_account_insert ON store_account;
DROP TRIGGER IF EXISTS store_account_delete ON store_account;
DROP TRIGGER IF EXISTS store_account_update ON store_account;

--

CREATE TRIGGER user_account_insert BEFORE INSERT ON user_account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER user_account_delete BEFORE DELETE ON user_account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER user_account_update BEFORE UPDATE ON user_account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER store_account_insert BEFORE INSERT ON store_account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER store_account_delete BEFORE DELETE ON store_account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER store_account_update BEFORE UPDATE ON store_account FOR EACH ROW EXECUTE PROCEDURE account();

-- tag

DROP TRIGGER IF EXISTS currency_insert ON currency;
DROP TRIGGER IF EXISTS currency_delete ON currency;
DROP TRIGGER IF EXISTS currency_update ON currency;
DROP TRIGGER IF EXISTS category_insert ON category;
DROP TRIGGER IF EXISTS category_delete ON category;
DROP TRIGGER IF EXISTS category_update ON category;

--

CREATE TRIGGER currency_insert BEFORE INSERT ON currency FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER currency_delete BEFORE DELETE ON currency FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER currency_update BEFORE UPDATE ON currency FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER category_insert BEFORE INSERT ON category FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER category_delete BEFORE DELETE ON category FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER category_update BEFORE UPDATE ON category FOR EACH ROW EXECUTE PROCEDURE tag();

-- item

DROP TRIGGER IF EXISTS sales_item_insert ON sales_item;
DROP TRIGGER IF EXISTS sales_item_delete ON sales_item;
DROP TRIGGER IF EXISTS sales_item_update ON sales_item;
DROP TRIGGER IF EXISTS sales_order_insert ON sales_order;
DROP TRIGGER IF EXISTS sales_order_delete ON sales_order;
DROP TRIGGER IF EXISTS sales_order_update ON sales_order;
DROP TRIGGER IF EXISTS store_account_insert ON store_account;
DROP TRIGGER IF EXISTS store_account_delete ON store_account;
DROP TRIGGER IF EXISTS store_account_update ON store_account;
DROP TRIGGER IF EXISTS store_insert ON store;
DROP TRIGGER IF EXISTS store_delete ON store;
DROP TRIGGER IF EXISTS store_update ON store;

--

CREATE TRIGGER sales_item_insert BEFORE INSERT ON sales_item FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER sales_item_delete BEFORE DELETE ON sales_item FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER sales_item_update BEFORE UPDATE ON sales_item FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER sales_order_insert BEFORE INSERT ON sales_order FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER sales_order_delete BEFORE DELETE ON sales_order FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER sales_order_update BEFORE UPDATE ON sales_order FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER store_account_insert BEFORE INSERT ON store_account FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER store_account_delete BEFORE DELETE ON store_account FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER store_account_update BEFORE UPDATE ON store_account FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER store_insert BEFORE INSERT ON store FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER store_delete BEFORE DELETE ON store FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER store_update BEFORE UPDATE ON store FOR EACH ROW EXECUTE PROCEDURE item();
