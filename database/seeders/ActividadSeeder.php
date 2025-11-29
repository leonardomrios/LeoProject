<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\Subactividad;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar actividades existentes
        Actividad::truncate();

        $fechaInicio = Carbon::create(2026, 1, 20); // 20 de enero de 2026
        $horasSemanales = 9; // 3 días × 3 horas
        $horasPorDia = 3;
        
        // Días festivos de Colombia 2026, 2027 y 2028
        $festivosColombia = [
            // 2026
            '2026-01-01', // Año Nuevo
            '2026-01-12', // Día de los Reyes Magos
            '2026-03-23', // Día de San José
            '2026-03-24', // Jueves Santo
            '2026-03-25', // Viernes Santo
            '2026-03-28', // Lunes de Pascua
            '2026-05-01', // Día del Trabajo
            '2026-05-09', // Día de la Ascensión
            '2026-05-30', // Corpus Christi
            '2026-06-20', // Sagrado Corazón
            '2026-06-27', // San Pedro y San Pablo
            '2026-07-04', // Día de la Independencia
            '2026-07-20', // Día de la Independencia
            '2026-08-07', // Batalla de Boyacá
            '2026-08-15', // Asunción de la Virgen
            '2026-10-12', // Día de la Raza
            '2026-11-02', // Día de los Difuntos
            '2026-11-16', // Independencia de Cartagena
            '2026-12-08', // Día de la Inmaculada Concepción
            '2026-12-25', // Navidad
            // 2027
            '2027-01-01', // Año Nuevo
            '2027-01-09', // Día de los Reyes Magos
            '2027-03-20', // Día de San José
            '2027-04-08', // Jueves Santo
            '2027-04-09', // Viernes Santo
            '2027-04-10', // Lunes de Pascua
            '2027-05-01', // Día del Trabajo
            '2027-05-22', // Día de la Ascensión
            '2027-06-12', // Corpus Christi
            '2027-06-19', // Sagrado Corazón
            '2027-06-29', // San Pedro y San Pablo
            '2027-07-03', // Día de la Independencia
            '2027-07-20', // Día de la Independencia
            '2027-08-07', // Batalla de Boyacá
            '2027-08-15', // Asunción de la Virgen
            '2027-10-12', // Día de la Raza
            '2027-11-01', // Día de los Difuntos
            '2027-11-13', // Independencia de Cartagena
            '2027-12-08', // Día de la Inmaculada Concepción
            '2027-12-25', // Navidad
            // 2028
            '2028-01-01', // Año Nuevo
            '2028-01-10', // Día de los Reyes Magos
            '2028-03-19', // Día de San José
            '2028-03-23', // Jueves Santo
            '2028-03-24', // Viernes Santo
            '2028-03-27', // Lunes de Pascua
            '2028-05-01', // Día del Trabajo
            '2028-05-14', // Día de la Ascensión
            '2028-06-04', // Corpus Christi
            '2028-06-11', // Sagrado Corazón
            '2028-06-29', // San Pedro y San Pablo
            '2028-07-03', // Día de la Independencia
            '2028-07-20', // Día de la Independencia
            '2028-08-07', // Batalla de Boyacá
            '2028-08-15', // Asunción de la Virgen
            '2028-10-12', // Día de la Raza
            '2028-11-02', // Día de los Difuntos
            '2028-11-13', // Independencia de Cartagena
            '2028-12-08', // Día de la Inmaculada Concepción
            '2028-12-25', // Navidad
        ];
        
        // Convertir a objetos Carbon para comparación
        $festivos = array_map(function($fecha) {
            return Carbon::parse($fecha);
        }, $festivosColombia);
        
        // Función para verificar si una fecha es día hábil (lunes a viernes, no festivo)
        $esDiaHabil = function($fecha) use ($festivos) {
            // No es sábado (6) ni domingo (0)
            if ($fecha->dayOfWeek == Carbon::SATURDAY || $fecha->dayOfWeek == Carbon::SUNDAY) {
                return false;
            }
            // No es día festivo
            foreach ($festivos as $festivo) {
                if ($fecha->isSameDay($festivo)) {
                    return false;
                }
            }
            return true;
        };
        
        // Función para obtener el siguiente día hábil
        $siguienteDiaHabil = function($fecha) use ($esDiaHabil) {
            $fecha = $fecha->copy()->addDay();
            while (!$esDiaHabil($fecha)) {
                $fecha->addDay();
            }
            return $fecha;
        };
        
        // Función para contar días hábiles entre dos fechas
        $contarDiasHabiles = function($fechaInicio, $fechaFin) use ($esDiaHabil) {
            $contador = 0;
            $fecha = $fechaInicio->copy();
            while ($fecha <= $fechaFin) {
                if ($esDiaHabil($fecha)) {
                    $contador++;
                }
                $fecha->addDay();
            }
            return $contador;
        };
        
        // Función para avanzar N días hábiles
        $avanzarDiasHabiles = function($fecha, $diasHabiles) use ($esDiaHabil) {
            $fecha = $fecha->copy();
            $contador = 0;
            
            // Si la fecha inicial no es día hábil, avanzar al siguiente
            if (!$esDiaHabil($fecha)) {
                $fecha->addDay();
                while (!$esDiaHabil($fecha)) {
                    $fecha->addDay();
                }
            }
            
            // Avanzar los días hábiles necesarios
            while ($contador < $diasHabiles) {
                if ($esDiaHabil($fecha)) {
                    $contador++;
                }
                if ($contador < $diasHabiles) {
                    $fecha->addDay();
                }
            }
            
            return $fecha;
        };
        
        // Asegurar que la fecha de inicio sea día hábil
        $fechaActual = $fechaInicio->copy();
        if (!$esDiaHabil($fechaActual)) {
            $fechaActual = $siguienteDiaHabil($fechaActual);
        }
        $horasAcumuladas = 0;

        // CATEGORÍA 1: Fundamentos de Python y Configuración del Entorno
        $categoria1 = [
            'nombre' => 'Fundamentos de Python y Configuración del Entorno',
            'actividades' => [
                [
                    'nombre' => 'Programación Core de Python',
                    'horas' => 36,
                    'subactividades' => [
                        ['nombre' => 'Estructuras de Datos (listas, diccionarios, sets, tuplas)', 'horas' => 6, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Control de Flujo (if/else, loops, comprehensions)', 'horas' => 6, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Funciones, Generadores y Decoradores', 'horas' => 9, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Programación Orientada a Objetos (clases, herencia)', 'horas' => 9, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Manejo de Errores y Debugging', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'File I/O y Context Managers', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                    ]
                ],
                [
                    'nombre' => 'Stack Científico de Python',
                    'horas' => 42,
                    'subactividades' => [
                        ['nombre' => 'NumPy para computación numérica', 'horas' => 9, 'recurso' => 'NumPy.org, NumPy User Guide'],
                        ['nombre' => 'Pandas para manipulación y análisis de datos', 'horas' => 12, 'recurso' => 'Pandas.pydata.org, 10 Minutes to Pandas'],
                        ['nombre' => 'Matplotlib y Seaborn para visualización', 'horas' => 9, 'recurso' => 'Matplotlib.org, Seaborn.pydata.org'],
                        ['nombre' => 'Fundamentos de Scikit-learn', 'horas' => 9, 'recurso' => 'Scikit-learn.org, Getting Started'],
                        ['nombre' => 'Entornos virtuales (venv, Conda)', 'horas' => 3, 'recurso' => 'Python.org venv, Conda.io'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 2: Conceptos Core de Machine Learning
        $categoria2 = [
            'nombre' => 'Conceptos Core de Machine Learning',
            'actividades' => [
                [
                    'nombre' => 'Herramientas de Desarrollo y Buenas Prácticas',
                    'horas' => 30,
                    'subactividades' => [
                        ['nombre' => 'Git y GitHub para control de versiones', 'horas' => 6, 'recurso' => 'Git-scm.com, GitHub Docs'],
                        ['nombre' => 'IDEs (VS Code, PyCharm)', 'horas' => 3, 'recurso' => 'VS Code Docs, PyCharm Guide'],
                        ['nombre' => 'Frameworks de testing (pytest)', 'horas' => 6, 'recurso' => 'Pytest.org'],
                        ['nombre' => 'Estilo de código (PEP 8, Black)', 'horas' => 3, 'recurso' => 'PEP 8, Black docs'],
                        ['nombre' => 'Gestión de paquetes (pip, poetry)', 'horas' => 3, 'recurso' => 'Pip docs, Poetry docs'],
                        ['nombre' => 'Práctica: Configurar proyecto ML completo', 'horas' => 9, 'recurso' => 'Proyecto práctico'],
                    ]
                ],
                [
                    'nombre' => 'Aprendizaje Supervisado',
                    'horas' => 48,
                    'subactividades' => [
                        ['nombre' => 'Regresión (Lineal, Ridge, Lasso)', 'horas' => 12, 'recurso' => 'Scikit-learn Regression, ISLR Book'],
                        ['nombre' => 'Clasificación (Logística, SVM, Árboles, Random Forests)', 'horas' => 15, 'recurso' => 'Scikit-learn Classification, ISLR Book'],
                        ['nombre' => 'Métricas de Evaluación (Accuracy, Precision, Recall, F1, RMSE, R2)', 'horas' => 6, 'recurso' => 'Scikit-learn Metrics'],
                        ['nombre' => 'Cross-validation y validación de modelos', 'horas' => 9, 'recurso' => 'Scikit-learn Cross-validation'],
                        ['nombre' => 'Trade-off Bias-Varianza y overfitting', 'horas' => 6, 'recurso' => 'ISLR Book, ML Theory'],
                    ]
                ],
                [
                    'nombre' => 'Aprendizaje No Supervisado',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'Clustering (K-Means, DBSCAN)', 'horas' => 9, 'recurso' => 'Scikit-learn Clustering'],
                        ['nombre' => 'Reducción de Dimensionalidad (PCA, t-SNE)', 'horas' => 9, 'recurso' => 'Scikit-learn Dimensionality Reduction'],
                        ['nombre' => 'Detección de Anomalías', 'horas' => 6, 'recurso' => 'Scikit-learn Anomaly Detection'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 3: Deep Learning y Frameworks
        $categoria3 = [
            'nombre' => 'Deep Learning y Frameworks',
            'actividades' => [
                [
                    'nombre' => 'Fundamentos de Deep Learning',
                    'horas' => 54,
                    'subactividades' => [
                        ['nombre' => 'Redes Neuronales Feedforward (conceptos básicos)', 'horas' => 12, 'recurso' => 'Deep Learning Book, Fast.ai'],
                        ['nombre' => 'Backpropagation y optimización (SGD, Adam)', 'horas' => 9, 'recurso' => 'Deep Learning Book'],
                        ['nombre' => 'Regularización (Dropout, Batch Normalization)', 'horas' => 6, 'recurso' => 'Deep Learning Book'],
                        ['nombre' => 'PyTorch: Fundamentos y tensores', 'horas' => 12, 'recurso' => 'PyTorch Tutorials, PyTorch Docs'],
                        ['nombre' => 'PyTorch: Construcción y entrenamiento de modelos', 'horas' => 15, 'recurso' => 'PyTorch Tutorials'],
                    ]
                ],
                [
                    'nombre' => 'Modelos Transformer y LLMs',
                    'horas' => 60,
                    'subactividades' => [
                        ['nombre' => 'Arquitectura Transformer: Self-attention y Multi-head attention', 'horas' => 12, 'recurso' => 'Attention Is All You Need Paper, Illustrated Transformer'],
                        ['nombre' => 'BERT y modelos encoder (RoBERTa, DistilBERT)', 'horas' => 9, 'recurso' => 'Hugging Face Transformers, BERT Paper'],
                        ['nombre' => 'GPT y modelos generativos (GPT-2, GPT-3)', 'horas' => 9, 'recurso' => 'Hugging Face Transformers, GPT Papers'],
                        ['nombre' => 'Hugging Face: Uso de modelos pre-entrenados', 'horas' => 9, 'recurso' => 'Hugging Face Course, Transformers Docs'],
                        ['nombre' => 'Fine-tuning de modelos pre-entrenados', 'horas' => 12, 'recurso' => 'Hugging Face Course, Fine-tuning Guide'],
                        ['nombre' => 'Conceptos de LLMs: Pre-training, fine-tuning, RLHF', 'horas' => 9, 'recurso' => 'RLHF Papers, Hugging Face'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 4: RAG y Aplicaciones LLM
        $categoria4 = [
            'nombre' => 'RAG y Aplicaciones LLM',
            'actividades' => [
                [
                    'nombre' => 'Retrieval-Augmented Generation (RAG)',
                    'horas' => 48,
                    'subactividades' => [
                        ['nombre' => 'Conceptos fundamentales de RAG', 'horas' => 6, 'recurso' => 'RAG Papers, LangChain RAG Guide'],
                        ['nombre' => 'Embeddings y modelos de embeddings (OpenAI, Sentence-BERT)', 'horas' => 9, 'recurso' => 'OpenAI Embeddings, Sentence-Transformers'],
                        ['nombre' => 'Vector Stores (Pinecone, Weaviate, FAISS, Chroma)', 'horas' => 9, 'recurso' => 'Pinecone Docs, Weaviate, FAISS, Chroma'],
                        ['nombre' => 'Carga y procesamiento de documentos (chunking, splitting)', 'horas' => 6, 'recurso' => 'LangChain Document Loaders'],
                        ['nombre' => 'Implementación de pipeline RAG completo', 'horas' => 12, 'recurso' => 'LangChain RAG Tutorial, RAG Best Practices'],
                        ['nombre' => 'Optimización de RAG: Query expansion, re-ranking', 'horas' => 6, 'recurso' => 'RAG Optimization Techniques'],
                    ]
                ],
                [
                    'nombre' => 'Prompt Engineering y Aplicaciones LLM',
                    'horas' => 27,
                    'subactividades' => [
                        ['nombre' => 'Técnicas de Prompt Engineering (zero-shot, few-shot, CoT)', 'horas' => 9, 'recurso' => 'OpenAI Prompt Engineering Guide, CoT Paper'],
                        ['nombre' => 'Aplicaciones LLM: Clasificación de texto, NER, QA', 'horas' => 6, 'recurso' => 'Hugging Face Tasks'],
                        ['nombre' => 'Aplicaciones LLM: Resumen, traducción, generación', 'horas' => 6, 'recurso' => 'Hugging Face Tasks'],
                        ['nombre' => 'Evaluación de modelos LLM (métricas, benchmarks)', 'horas' => 6, 'recurso' => 'LLM Evaluation Papers, HELM'],
                        ['nombre' => 'Mitigación de alucinaciones y seguridad en LLMs', 'horas' => 3, 'recurso' => 'Hallucination Detection, LLM Safety'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 5: Framework LangChain
        $categoria5 = [
            'nombre' => 'Framework LangChain',
            'actividades' => [
                [
                    'nombre' => 'Componentes Core de LangChain',
                    'horas' => 27,
                    'subactividades' => [
                        ['nombre' => 'Modelos (LLMs, ChatModels, Embeddings)', 'horas' => 6, 'recurso' => 'LangChain Docs - Models'],
                        ['nombre' => 'Prompts (PromptTemplates, ChatPromptTemplates)', 'horas' => 6, 'recurso' => 'LangChain Docs - Prompts'],
                        ['nombre' => 'Chains (LLMChain, SequentialChain)', 'horas' => 9, 'recurso' => 'LangChain Docs - Chains'],
                        ['nombre' => 'Agents y Tools', 'horas' => 9, 'recurso' => 'LangChain Docs - Agents'],
                        ['nombre' => 'Memory (ConversationBufferMemory)', 'horas' => 3, 'recurso' => 'LangChain Docs - Memory'],
                    ]
                ],
                [
                    'nombre' => 'RAG con LangChain',
                    'horas' => 36,
                    'subactividades' => [
                        ['nombre' => 'Document Loaders y Splitters', 'horas' => 6, 'recurso' => 'LangChain Docs - Document Loaders'],
                        ['nombre' => 'Vector Stores en LangChain (Chroma, Pinecone, FAISS)', 'horas' => 9, 'recurso' => 'LangChain Docs - Vector Stores'],
                        ['nombre' => 'Retrievers y técnicas de recuperación', 'horas' => 6, 'recurso' => 'LangChain Docs - Retrievers'],
                        ['nombre' => 'Implementación de RAG pipeline completo', 'horas' => 12, 'recurso' => 'LangChain RAG Tutorial'],
                        ['nombre' => 'Evaluación y optimización de sistemas RAG', 'horas' => 6, 'recurso' => 'LangChain Evaluation, RAG Evaluation'],
                    ]
                ],
                [
                    'nombre' => 'Aplicaciones Avanzadas con LangChain',
                    'horas' => 33,
                    'subactividades' => [
                        ['nombre' => 'Agents autónomos con herramientas personalizadas', 'horas' => 12, 'recurso' => 'LangChain Agents, AutoGPT'],
                        ['nombre' => 'Integración con bases de datos y APIs', 'horas' => 9, 'recurso' => 'LangChain Integrations'],
                        ['nombre' => 'Chains personalizados y composición', 'horas' => 6, 'recurso' => 'LangChain Advanced Chains'],
                        ['nombre' => 'Despliegue de aplicaciones LangChain en producción', 'horas' => 6, 'recurso' => 'LangChain Production Guide'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 6: Ingeniería ML y MLOps
        $categoria6 = [
            'nombre' => 'Ingeniería ML y MLOps',
            'actividades' => [
                [
                    'nombre' => 'Pipelines de Datos y Feature Engineering',
                    'horas' => 36,
                    'subactividades' => [
                        ['nombre' => 'Ingesta de datos (APIs, bases de datos, archivos)', 'horas' => 6, 'recurso' => 'Data Ingestion Patterns'],
                        ['nombre' => 'Transformación de datos (ETL básico)', 'horas' => 9, 'recurso' => 'ETL Patterns'],
                        ['nombre' => 'Validación de datos (Great Expectations básico)', 'horas' => 6, 'recurso' => 'Great Expectations'],
                        ['nombre' => 'Feature Engineering y selección de características', 'horas' => 9, 'recurso' => 'Feature Engineering Guide'],
                        ['nombre' => 'Conceptos de Feature Stores (Feast)', 'horas' => 6, 'recurso' => 'Feast Docs'],
                    ]
                ],
                [
                    'nombre' => 'Despliegue y Servicio de Modelos',
                    'horas' => 51,
                    'subactividades' => [
                        ['nombre' => 'APIs RESTful para ML (FastAPI)', 'horas' => 12, 'recurso' => 'FastAPI Docs, FastAPI for ML'],
                        ['nombre' => 'Containerización con Docker', 'horas' => 9, 'recurso' => 'Docker Docs, Docker for ML'],
                        ['nombre' => 'Versionado de modelos (MLflow)', 'horas' => 9, 'recurso' => 'MLflow Docs'],
                        ['nombre' => 'Serving de modelos (MLflow, BentoML)', 'horas' => 9, 'recurso' => 'MLflow Serving, BentoML'],
                        ['nombre' => 'Kubernetes básico para ML', 'horas' => 12, 'recurso' => 'Kubernetes Docs, ML on K8s'],
                    ]
                ],
                [
                    'nombre' => 'Monitoreo y Mantenimiento',
                    'horas' => 27,
                    'subactividades' => [
                        ['nombre' => 'Monitoreo de modelos en producción (drift, performance)', 'horas' => 9, 'recurso' => 'Evidently AI, MLflow Monitoring'],
                        ['nombre' => 'Logging y observabilidad (Prometheus, Grafana básico)', 'horas' => 6, 'recurso' => 'Prometheus, Grafana'],
                        ['nombre' => 'A/B testing para modelos', 'horas' => 6, 'recurso' => 'A/B Testing for ML'],
                        ['nombre' => 'Estrategias de reentrenamiento', 'horas' => 6, 'recurso' => 'Model Retraining Strategies'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 7: Computación en la Nube para ML
        $categoria7 = [
            'nombre' => 'Computación en la Nube para ML',
            'actividades' => [
                [
                    'nombre' => 'Fundamentos de Cloud (AWS, GCP)',
                    'horas' => 30,
                    'subactividades' => [
                        ['nombre' => 'Servicios de cómputo (EC2, Cloud Run)', 'horas' => 9, 'recurso' => 'AWS EC2, GCP Cloud Run'],
                        ['nombre' => 'Servicios de almacenamiento (S3, GCS)', 'horas' => 6, 'recurso' => 'AWS S3, GCP GCS'],
                        ['nombre' => 'Servicios de bases de datos (RDS, Cloud SQL)', 'horas' => 6, 'recurso' => 'AWS RDS, GCP Cloud SQL'],
                        ['nombre' => 'Networking básico (VPC, security groups)', 'horas' => 6, 'recurso' => 'AWS VPC, GCP VPC'],
                        ['nombre' => 'IAM y seguridad básica', 'horas' => 3, 'recurso' => 'AWS IAM, GCP IAM'],
                    ]
                ],
                [
                    'nombre' => 'Servicios ML en Cloud',
                    'horas' => 36,
                    'subactividades' => [
                        ['nombre' => 'AWS SageMaker (entrenamiento, hosting)', 'horas' => 15, 'recurso' => 'AWS SageMaker Docs'],
                        ['nombre' => 'Google Cloud Vertex AI (datasets, modelos, endpoints)', 'horas' => 15, 'recurso' => 'Vertex AI Docs'],
                        ['nombre' => 'Serverless para ML (Lambda, Cloud Functions)', 'horas' => 6, 'recurso' => 'AWS Lambda, GCP Functions'],
                        ['nombre' => 'Containerización en cloud (ECR, GCR)', 'horas' => 6, 'recurso' => 'ECR, GCR Docs'],
                    ]
                ],
                [
                    'nombre' => 'Infrastructure as Code y CI/CD',
                    'horas' => 27,
                    'subactividades' => [
                        ['nombre' => 'Terraform básico para infraestructura ML', 'horas' => 9, 'recurso' => 'Terraform Docs, Terraform for ML'],
                        ['nombre' => 'CI/CD para ML (GitHub Actions)', 'horas' => 12, 'recurso' => 'GitHub Actions, ML CI/CD'],
                        ['nombre' => 'Pipelines automatizados de ML', 'horas' => 6, 'recurso' => 'ML Pipelines, GitHub Actions'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 8: Gestión de Proyectos e IA Ética
        $categoria8 = [
            'nombre' => 'Gestión de Proyectos e IA Ética',
            'actividades' => [
                [
                    'nombre' => 'Ciclo de Vida de Proyectos ML',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'Definición de problema y alcance', 'horas' => 3, 'recurso' => 'ML Project Planning'],
                        ['nombre' => 'Recolección y preparación de datos', 'horas' => 6, 'recurso' => 'Data Preparation'],
                        ['nombre' => 'Desarrollo y evaluación de modelos', 'horas' => 9, 'recurso' => 'Model Development'],
                        ['nombre' => 'Despliegue y MLOps', 'horas' => 6, 'recurso' => 'MLOps Guide'],
                    ]
                ],
                [
                    'nombre' => 'IA Ética y ML Responsable',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'Sesgo y equidad en ML (detección, mitigación)', 'horas' => 9, 'recurso' => 'Fairness in ML, AIF360'],
                        ['nombre' => 'Interpretabilidad de modelos (LIME, SHAP)', 'horas' => 9, 'recurso' => 'LIME, SHAP, Interpretability'],
                        ['nombre' => 'Privacidad y seguridad de datos (GDPR básico)', 'horas' => 3, 'recurso' => 'Privacy in ML, GDPR'],
                        ['nombre' => 'Responsabilidad y gobernanza de IA', 'horas' => 3, 'recurso' => 'AI Governance'],
                    ]
                ],
            ]
        ];

        // Agrupar todas las categorías
        $categorias = [
            $categoria1, $categoria2, $categoria3, $categoria4, $categoria5,
            $categoria6, $categoria7, $categoria8
        ];

        // Crear actividades y subactividades
        // $fechaActual ya está inicializada arriba como día hábil

        foreach ($categorias as $categoria) {
            foreach ($categoria['actividades'] as $actividadData) {
                // Calcular fechas para la actividad (solo días hábiles)
                $horasActividad = $actividadData['horas'];
                $diasHabilesNecesarios = ceil($horasActividad / $horasPorDia); // Días hábiles necesarios
                
                $fechaInicioActividad = $fechaActual->copy();
                // Asegurar que la fecha de inicio sea día hábil
                if (!$esDiaHabil($fechaInicioActividad)) {
                    $fechaInicioActividad = $siguienteDiaHabil($fechaInicioActividad);
                }

                // Crear subactividades PRIMERO para calcular el rango real necesario
                $fechaSubActual = $fechaInicioActividad->copy();
                $fechaFinActividadReal = $fechaInicioActividad->copy();
                $subactividadesCreadas = [];

                foreach ($actividadData['subactividades'] as $index => $subactividadData) {
                    $horasSub = $subactividadData['horas'];
                    // Calcular días hábiles necesarios: cada día hábil = 3 horas
                    $diasHabilesSub = max(1, (int) ceil($horasSub / $horasPorDia));
                    
                    // Calcular fechas de inicio y fin (solo días hábiles)
                    $fechaInicioSub = $fechaSubActual->copy();
                    if (!$esDiaHabil($fechaInicioSub)) {
                        $fechaInicioSub = $siguienteDiaHabil($fechaInicioSub);
                    }
                    
                    // Avanzar los días hábiles necesarios para la subactividad (diasHabilesSub - 1 porque el primer día ya está incluido)
                    $fechaFinSub = $avanzarDiasHabiles($fechaInicioSub, $diasHabilesSub - 1);
                    
                    // Guardar datos de la subactividad para crearla después
                    $subactividadesCreadas[] = [
                        'nombre' => $subactividadData['nombre'],
                        'descripcion' => "Horas estimadas: {$horasSub}h. Recurso: {$subactividadData['recurso']}",
                        'fecha_inicio' => $fechaInicioSub,
                        'fecha_fin' => $fechaFinSub,
                        'orden' => $index + 1,
                    ];

                    // Actualizar la fecha fin real de la actividad (debe incluir todas las subactividades)
                    if ($fechaFinSub->gt($fechaFinActividadReal)) {
                        $fechaFinActividadReal = $fechaFinSub->copy();
                    }

                    // Avanzar al siguiente día hábil después de la fecha fin de esta subactividad
                    $fechaSubActual = $siguienteDiaHabil($fechaFinSub);
                }

                // Crear actividad con el rango real calculado desde las subactividades
                $actividad = Actividad::create([
                    'nombre' => $actividadData['nombre'],
                    'descripcion' => "Categoría: {$categoria['nombre']}. " . 
                                   "Horas totales: {$horasActividad}h. " .
                                   "Recursos: " . implode(', ', array_unique(array_column($actividadData['subactividades'], 'recurso'))),
                    'fecha_inicio' => $fechaInicioActividad,
                    'fecha_fin' => $fechaFinActividadReal,
                    'progreso' => 0,
                    'estado' => 'pendiente',
                    'prioridad' => $this->determinarPrioridad($categoria['nombre']),
                    'color' => $this->obtenerColor($categoria['nombre']),
                ]);

                // Crear todas las subactividades
                foreach ($subactividadesCreadas as $subData) {
                    Subactividad::create([
                        'actividad_id' => $actividad->id,
                        'nombre' => $subData['nombre'],
                        'descripcion' => $subData['descripcion'],
                        'fecha_inicio' => $subData['fecha_inicio'],
                        'fecha_fin' => $subData['fecha_fin'],
                        'progreso' => 0,
                        'estado' => 'pendiente',
                        'orden' => $subData['orden'],
                    ]);
                }

                // Avanzar al siguiente día hábil después de la fecha fin de la actividad
                $fechaActual = $siguienteDiaHabil($fechaFinActividadReal);
                $horasAcumuladas += $horasActividad;
            }
        }

        // Recalcular progreso de todas las actividades
        Actividad::all()->each(function($actividad) {
            $actividad->calcularProgresoDesdeSubactividades();
        });

        $totalActividades = Actividad::count();
        $totalSubactividades = Subactividad::count();
        $fechaFinTotal = Carbon::parse(Actividad::max('fecha_fin'));
        $duracionTotal = $fechaInicio->diffInDays($fechaFinTotal) + 1;
        $semanasTotales = ceil($duracionTotal / 7);

        $this->command->info('✅ Se ha creado el roadmap optimizado de "Machine Learning Engineer"');
        $this->command->info("   - {$totalActividades} actividades principales");
        $this->command->info("   - {$totalSubactividades} subactividades");
        $this->command->info("   - Duración total: {$duracionTotal} días ({$semanasTotales} semanas)");
        $this->command->info("   - Fecha de inicio: {$fechaInicio->format('d/m/Y')}");
        $this->command->info("   - Fecha de fin estimada: {$fechaFinTotal->format('d/m/Y')}");
        $this->command->info("   - Horas totales estimadas: " . array_sum(array_column(array_merge(...array_column($categorias, 'actividades')), 'horas')) . "h");
    }

    private function determinarPrioridad($categoria)
    {
        $prioridades = [
            'Fundamentos de Python' => 'critica',
            'Conceptos Core de Machine Learning' => 'critica',
            'Deep Learning y Frameworks' => 'alta',
            'RAG y Aplicaciones LLM' => 'alta',
            'Framework LangChain' => 'alta',
            'Ingeniería ML y MLOps' => 'alta',
            'Computación en la Nube' => 'alta',
            'Gestión de Proyectos' => 'media',
        ];

        foreach ($prioridades as $key => $prioridad) {
            if (str_contains($categoria, $key)) {
                return $prioridad;
            }
        }

        return 'media';
    }

    private function obtenerColor($categoria)
    {
        $colores = [
            'Fundamentos de Python' => '#10b981',
            'Conceptos Core de Machine Learning' => '#6366f1',
            'Deep Learning y Frameworks' => '#8b5cf6',
            'RAG y Aplicaciones LLM' => '#f59e0b',
            'Framework LangChain' => '#ef4444',
            'Ingeniería ML y MLOps' => '#3b82f6',
            'Computación en la Nube' => '#f97316',
            'Gestión de Proyectos' => '#84cc16',
        ];

        foreach ($colores as $key => $color) {
            if (str_contains($categoria, $key)) {
                return $color;
            }
        }

        return '#6366f1';
    }
}
