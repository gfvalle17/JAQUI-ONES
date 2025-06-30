pipeline {
    agent any // Ejecutar en cualquier agente disponible

    stages {
        stage('1. Clonar Código') {
            steps {
                checkout scm
                echo '¡Código clonado desde GitHub exitosamente!'
            }
        }

        stage('2. Verificar Entorno Docker') {
            steps {
                sh 'docker --version'
                sh 'docker compose --version'
            }
        }

        // --- Etapas de SonarQube añadidas ---

        stage('3. Análisis con SonarQube') {
            steps {
                script {
                    // 'SonarQubeServer' es el nombre que configuraste en Jenkins
                    withSonarQubeEnv('SonarQubeServer') {
                        // El scanner usa el archivo sonar-project.properties que creaste
                        sh 'sonar-scanner'
                    }
                }
            }
        }

        stage('4. Comprobar Quality Gate') {
            steps {
                // Espera hasta 1 hora a que SonarQube termine el análisis
                timeout(time: 1, unit: 'HOURS') {
                    // Si el código no cumple con los estándares de calidad,
                    // el pipeline se detendrá y fallará.
                    waitForQualityGate abortPipeline: true
                }
            }
        }
    }
}