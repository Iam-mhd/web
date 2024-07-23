CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    product_name VARCHAR(255) 
);

DELIMITER //

CREATE TRIGGER after_product_insert
AFTER INSERT ON produits
FOR EACH ROW
BEGIN
    UPDATE categories
    SET product_name = NEW.name
    WHERE id = NEW.category_id;
END //

DELIMITER ;



CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);


INSERT INTO categories (name) VALUES 
('Sandales Traditionnelles'), 
('Bottes en Cuir'), 
('Chaussures de Mariage'), 
('Ballerines Africaines'), 
('Chaussures en Tissu Wax'), 
('Espadrilles Africaines'), 
('Mocassins Traditionnels'), 
('Chaussures de Travail en Cuir'), 
('Sandales en Perles'), 
('Babouches Africaines'), 
('Chaussures pour Enfants'), 
('Chaussures de Sport');
