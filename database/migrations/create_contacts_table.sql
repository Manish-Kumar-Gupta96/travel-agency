CREATE TABLE contacts (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL,

    message TEXT NOT NULL,


    status ENUM(

        'new',

        'read',

        'replied'

    )

    DEFAULT 'new',


    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ON UPDATE CURRENT_TIMESTAMP

);
