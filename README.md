# Ejemplos de POO en Laravel

En este proyecto se implementan conceptos de POO en Laravel, usando una Rest Api para gestionar productos.

Los conceptos implementados son : 

Herencia : Se utilizó para extender la funcionalidad de la clase Producto en ProductoFisico y ProductoDigital, reutilizando atributos y métodos comunes.

Composición: En el ejemplo, la clase Producto tiene una relación con un Proveedor, lo que permite modelar la dependencia entre ambos sin extender clases innecesariamente.

Encapsulamiento: Se implementó un método seguro llamado actualizarStock() en el modelo Producto, evitando modificaciones directas desde el ProductoController.

Polimorfismo: Se implementó mediante la definición de la interfaz MetodoPagoInterface, que se declara en el método procesarPago(). Esto obliga a que todas las clases que se implementen en esta interfaz ( PagoTarjeta y PagoPayPal) definan su propia lógica para procesar el pago. Además, se utilizó inyección de dependencias en ApiController, donde PagoService es inyectado y utilizado para gestionar los pagos, permitiendo que el comportamiento de los métodos de pago varíe según la implementación.

Abstracción: 

Se implementó mediante la creación de la interfaz MetodoEnvioInterface, que se define en el método enviar(), y la clase abstracta MetodoEnvioAbstract que proporciona una implementación base para registrar los envíos. De este modo, todas las clases concretas (EnvioAereo y EnvioTerrestre) reutilizan esta funcionalidad sin preocuparse por los detalles de implementación.

Además, se implementó la fábrica MetodoEnvioFactory, que encapsula la lógica de selección del método de envío, permitiendo que EnvioService simplemente llame al servicio sin necesidad de saber qué tipo de envío se está usando. Tambien se usó inyección de servicios en ApiController, donde EnvioService es inyectado y utilizado para gestionar los envíos, permitiendo que la lógica de envío se mantenga desacoplada y abstracta.