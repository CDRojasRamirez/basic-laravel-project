-- Script SQL para insertar productos de ejemplo en GOAPPY
-- Ejecutar después de las migraciones

INSERT INTO products (name, price, description, url, created_at, updated_at) VALUES
('Laptop Gaming Pro', 1299.99, 'Laptop de alto rendimiento con procesador Intel i7, 16GB RAM, RTX 3060, pantalla 144Hz perfecta para gaming y trabajo profesional.', 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=400', NOW(), NOW()),

('Smartphone Ultra 5G', 899.99, 'Smartphone de última generación con pantalla AMOLED 6.7", cámara triple 108MP, 5G, batería de larga duración y carga rápida.', 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400', NOW(), NOW()),

('Auriculares Bluetooth Premium', 249.99, 'Auriculares inalámbricos con cancelación de ruido activa, sonido Hi-Fi, 30 horas de batería y diseño ergonómico ultra cómodo.', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400', NOW(), NOW()),

('Smart Watch Fitness', 199.99, 'Reloj inteligente con monitor de frecuencia cardíaca, GPS, resistente al agua, seguimiento de actividad y notificaciones inteligentes.', 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400', NOW(), NOW()),

('Tablet Pro 12.9"', 799.99, 'Tablet profesional con pantalla Retina, chip M1, Apple Pencil compatible, ideal para diseño, productividad y entretenimiento.', 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=400', NOW(), NOW()),

('Cámara Mirrorless 4K', 1499.99, 'Cámara profesional sin espejo con sensor full-frame, grabación 4K 60fps, estabilización de imagen y lentes intercambiables.', 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=400', NOW(), NOW()),

('Teclado Mecánico RGB', 149.99, 'Teclado mecánico gaming con switches Cherry MX, iluminación RGB personalizable, reposamuñecas y teclas programables.', 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400', NOW(), NOW()),

('Mouse Gaming Wireless', 89.99, 'Mouse inalámbrico de alta precisión con sensor óptico 16000 DPI, 6 botones programables y batería de 70 horas.', 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400', NOW(), NOW()),

('Monitor 4K UHD 27"', 449.99, 'Monitor profesional 4K con panel IPS, 99% sRGB, HDR10, 60Hz, perfecto para edición de foto/video y gaming.', 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400', NOW(), NOW()),

('Bocina Bluetooth Portátil', 79.99, 'Bocina inalámbrica resistente al agua IPX7, sonido 360°, 12 horas de batería, perfecta para exteriores y fiestas.', 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400', NOW(), NOW()),

('Webcam HD 1080p', 69.99, 'Webcam profesional con micrófono dual, enfoque automático, corrección de luz, ideal para videollamadas y streaming.', 'https://images.unsplash.com/photo-1587826080692-f439cd0b70da?w=400', NOW(), NOW()),

('SSD Externo 1TB', 129.99, 'Disco sólido externo ultrarrápido, USB-C 3.2, velocidades de hasta 1050MB/s, compacto y resistente a golpes.', 'https://images.unsplash.com/photo-1531492746076-161ca9bcad58?w=400', NOW(), NOW());
