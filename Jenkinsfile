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
                // Envolvemos toda la lógica en un bloque 'script'
                script {
                    withCredentials([string(credentialsId: 'sonarqube-token', variable: 'SONAR_TOKEN')]) {
                        withSonarQubeEnv('SonarQubeServer') {
                            def sonarScannerTool = tool 'SonarScannerDefault'
                            
                            // Añadimos el token al comando del scanner
                            sh "${sonarScannerTool}/bin/sonar-scanner -Dsonar.login=${SONAR_TOKEN}"
                        }
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