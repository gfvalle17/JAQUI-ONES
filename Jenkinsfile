pipeline {
    agent any // Ejecutar en cualquier agente disponible

    stages {
        stage('1. Clonar Código') {
            steps {
                // Jenkins ya clona el código automáticamente con la configuración que hicimos,
                // pero este paso confirma que todo funciona.
                checkout scm
                echo '¡Código clonado desde GitHub exitosamente!'
            }
        }
        stage('2. Verificar Entorno Docker') {
            steps {
                // Este es nuestro "Hola Mundo". Le pedimos a Jenkins que ejecute un comando
                // de Docker para confirmar que la integración que hicimos funciona.
                sh 'docker --version'
                sh 'docker compose --version'
            }
        }
    }
}