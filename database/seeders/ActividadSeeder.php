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
        
        $fechaActual = $fechaInicio->copy();
        $horasAcumuladas = 0;

        // Función para calcular fecha fin basada en horas
        $calcularFechaFin = function($horas) use (&$fechaActual, &$horasAcumuladas, $horasSemanales, $horasPorDia) {
            $horasAcumuladas += $horas;
            $semanasNecesarias = ceil($horasAcumuladas / $horasSemanales);
            $diasNecesarios = $semanasNecesarias * 7;
            $fechaInicioActividad = $fechaActual->copy();
            $fechaActual->addDays($diasNecesarios);
            return [
                'inicio' => $fechaInicioActividad,
                'fin' => $fechaActual->copy()->subDay()
            ];
        };

        // CATEGORÍA 1: Fundamentos de Python y Configuración del Entorno
        $categoria1 = [
            'nombre' => 'Fundamentos de Python y Configuración del Entorno',
            'actividades' => [
                [
                    'nombre' => 'Programación Core de Python',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Estructuras de Datos (listas, diccionarios, sets, tuplas)', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Control de Flujo (if/else, loops, comprehensions)', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Funciones, Generadores y Decoradores', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Programación Orientada a Objetos (clases, herencia, polimorfismo)', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Manejo de Errores y Debugging', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'File I/O y Context Managers', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                    ]
                ],
                [
                    'nombre' => 'Stack Científico de Python',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'NumPy para computación numérica', 'horas' => 3, 'recurso' => 'NumPy.org, NumPy User Guide'],
                        ['nombre' => 'Pandas para manipulación y análisis de datos', 'horas' => 6, 'recurso' => 'Pandas.pydata.org, 10 Minutes to Pandas'],
                        ['nombre' => 'Matplotlib y Seaborn para visualización de datos', 'horas' => 3, 'recurso' => 'Matplotlib.org, Seaborn.pydata.org'],
                        ['nombre' => 'SciPy para computación científica', 'horas' => 3, 'recurso' => 'SciPy.org, SciPy Lecture Notes'],
                        ['nombre' => 'Fundamentos de Scikit-learn para algoritmos ML', 'horas' => 3, 'recurso' => 'Scikit-learn.org, Getting Started'],
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
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Git y GitHub para control de versiones', 'horas' => 3, 'recurso' => 'Git-scm.com, GitHub Docs'],
                        ['nombre' => 'IDEs (VS Code, PyCharm)', 'horas' => 2, 'recurso' => 'VS Code Docs, PyCharm Guide'],
                        ['nombre' => 'Frameworks de testing (pytest, unittest)', 'horas' => 3, 'recurso' => 'Pytest.org, Python unittest'],
                        ['nombre' => 'Estilo de código (PEP 8, linters: Black, Flake8)', 'horas' => 2, 'recurso' => 'PEP 8, Black, Flake8 docs'],
                        ['nombre' => 'Técnicas de debugging', 'horas' => 3, 'recurso' => 'Python Debugging Guide'],
                        ['nombre' => 'Gestión de paquetes (pip, poetry)', 'horas' => 2, 'recurso' => 'Pip docs, Poetry docs'],
                        ['nombre' => 'Práctica integradora: Configurar proyecto ML completo', 'horas' => 3, 'recurso' => 'Proyecto práctico'],
                    ]
                ],
                [
                    'nombre' => 'Aprendizaje Supervisado',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'Regresión (Lineal, Polinomial, Ridge, Lasso)', 'horas' => 6, 'recurso' => 'Scikit-learn Regression, ISLR Book'],
                        ['nombre' => 'Clasificación (Regresión Logística, SVM, Árboles de Decisión, Random Forests)', 'horas' => 9, 'recurso' => 'Scikit-learn Classification, ISLR Book'],
                        ['nombre' => 'Métricas de Evaluación (RMSE, R2, Accuracy, Precision, Recall, F1-score)', 'horas' => 3, 'recurso' => 'Scikit-learn Metrics, ML Metrics Guide'],
                        ['nombre' => 'Técnicas de Cross-validation', 'horas' => 3, 'recurso' => 'Scikit-learn Cross-validation'],
                        ['nombre' => 'Trade-off Bias-Varianza', 'horas' => 3, 'recurso' => 'ISLR Book, ML Theory'],
                    ]
                ],
                [
                    'nombre' => 'Aprendizaje No Supervisado',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Clustering (K-Means, DBSCAN, Jerárquico)', 'horas' => 6, 'recurso' => 'Scikit-learn Clustering'],
                        ['nombre' => 'Reducción de Dimensionalidad (PCA, t-SNE, UMAP)', 'horas' => 6, 'recurso' => 'Scikit-learn Dimensionality Reduction'],
                        ['nombre' => 'Detección de Anomalías', 'horas' => 3, 'recurso' => 'Scikit-learn Anomaly Detection'],
                        ['nombre' => 'Minería de Reglas de Asociación (Apriori, FP-growth)', 'horas' => 3, 'recurso' => 'MLxtend, Association Rules'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 3: Deep Learning para NLP
        $categoria3 = [
            'nombre' => 'Deep Learning para NLP',
            'actividades' => [
                [
                    'nombre' => 'Librerías de NLP',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'NLTK para tareas básicas de NLP', 'horas' => 3, 'recurso' => 'NLTK.org, NLTK Book'],
                        ['nombre' => 'SpaCy para NLP de nivel producción', 'horas' => 3, 'recurso' => 'SpaCy.io, SpaCy Course'],
                        ['nombre' => 'Gensim para modelado de temas y word embeddings', 'horas' => 3, 'recurso' => 'Gensim.org, Gensim Tutorials'],
                        ['nombre' => 'Hugging Face Transformers para modelos state-of-the-art', 'horas' => 3, 'recurso' => 'Hugging Face Hub, Transformers Docs'],
                        ['nombre' => 'TextBlob para procesamiento de texto simplificado', 'horas' => 1.5, 'recurso' => 'TextBlob Docs'],
                        ['nombre' => 'Scikit-learn para extracción de características de texto', 'horas' => 1.5, 'recurso' => 'Scikit-learn Text Feature Extraction'],
                    ]
                ],
                [
                    'nombre' => 'Arquitecturas de Redes Neuronales',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Redes Neuronales Feedforward (FFNNs)', 'horas' => 3, 'recurso' => 'Deep Learning Book, PyTorch/TensorFlow'],
                        ['nombre' => 'Redes Neuronales Recurrentes (RNNs)', 'horas' => 3, 'recurso' => 'Deep Learning Book, PyTorch/TensorFlow'],
                        ['nombre' => 'Redes LSTM (Long Short-Term Memory)', 'horas' => 3, 'recurso' => 'Deep Learning Book, PyTorch/TensorFlow'],
                        ['nombre' => 'Unidades Recurrentes con Compuertas (GRUs)', 'horas' => 3, 'recurso' => 'Deep Learning Book, PyTorch/TensorFlow'],
                        ['nombre' => 'CNNs para texto', 'horas' => 3, 'recurso' => 'Deep Learning Book, PyTorch/TensorFlow'],
                        ['nombre' => 'Arquitecturas Encoder-Decoder', 'horas' => 3, 'recurso' => 'Deep Learning Book, PyTorch/TensorFlow'],
                        ['nombre' => 'Proyecto práctico: Implementar arquitectura completa', 'horas' => 3, 'recurso' => 'Proyecto práctico'],
                    ]
                ],
                [
                    'nombre' => 'Modelos Transformer',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'BERT y sus variantes (RoBERTa, ALBERT, DistilBERT)', 'horas' => 6, 'recurso' => 'Hugging Face Transformers, BERT Paper'],
                        ['nombre' => 'GPT y sus variantes (GPT-2, GPT-3, GPT-J)', 'horas' => 6, 'recurso' => 'Hugging Face Transformers, GPT Papers'],
                        ['nombre' => 'T5 y BART para tareas secuencia-a-secuencia', 'horas' => 3, 'recurso' => 'Hugging Face Transformers, T5/BART Papers'],
                        ['nombre' => 'Fine-tuning de modelos pre-entrenados', 'horas' => 6, 'recurso' => 'Hugging Face Course, Fine-tuning Guide'],
                        ['nombre' => 'Mecanismos de Atención (Self-attention, Multi-head attention)', 'horas' => 3, 'recurso' => 'Attention Is All You Need Paper'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 4: LLMs y Prompt Engineering
        $categoria4 = [
            'nombre' => 'LLMs y Prompt Engineering',
            'actividades' => [
                [
                    'nombre' => 'Aplicaciones Avanzadas de NLP',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Clasificación de Texto (análisis de sentimientos, detección de spam)', 'horas' => 3, 'recurso' => 'Hugging Face Tasks, Scikit-learn'],
                        ['nombre' => 'Reconocimiento de Entidades Nombradas (NER)', 'horas' => 3, 'recurso' => 'SpaCy NER, Hugging Face'],
                        ['nombre' => 'Sistemas de Question Answering (extractivo, generativo)', 'horas' => 3, 'recurso' => 'Hugging Face QA, SQuAD Dataset'],
                        ['nombre' => 'Resumen de Texto (extractivo, abstractivo)', 'horas' => 3, 'recurso' => 'Hugging Face Summarization'],
                        ['nombre' => 'Traducción Automática', 'horas' => 3, 'recurso' => 'Hugging Face Translation'],
                        ['nombre' => 'Chatbots y sistemas de IA conversacional', 'horas' => 3, 'recurso' => 'Rasa, Dialogflow, LangChain'],
                    ]
                ],
                [
                    'nombre' => 'Fundamentos de LLMs',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Conceptos de IA Generativa', 'horas' => 3, 'recurso' => 'Generative AI Papers, OpenAI Blog'],
                        ['nombre' => 'Leyes de escalado de modelos', 'horas' => 3, 'recurso' => 'Scaling Laws Papers'],
                        ['nombre' => 'Paradigmas de entrenamiento (pre-training, fine-tuning, RLHF)', 'horas' => 3, 'recurso' => 'RLHF Papers, Hugging Face'],
                        ['nombre' => 'Aprendizaje en contexto (in-context learning)', 'horas' => 3, 'recurso' => 'In-Context Learning Papers'],
                        ['nombre' => 'Aprendizaje few-shot y zero-shot', 'horas' => 3, 'recurso' => 'Few-Shot Learning Papers'],
                    ]
                ],
                [
                    'nombre' => 'Técnicas de Prompt Engineering',
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Zero-shot prompting', 'horas' => 2, 'recurso' => 'OpenAI Prompt Engineering Guide'],
                        ['nombre' => 'Few-shot prompting', 'horas' => 2, 'recurso' => 'OpenAI Prompt Engineering Guide'],
                        ['nombre' => 'Chain-of-Thought (CoT) prompting', 'horas' => 3, 'recurso' => 'CoT Paper, Prompt Engineering Guide'],
                        ['nombre' => 'Tree-of-Thought prompting', 'horas' => 2, 'recurso' => 'ToT Paper'],
                        ['nombre' => 'Role-playing y persona prompting', 'horas' => 2, 'recurso' => 'Prompt Engineering Best Practices'],
                        ['nombre' => 'Refinamiento iterativo de prompts', 'horas' => 1, 'recurso' => 'Prompt Engineering Guide'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 5: Framework LangChain
        $categoria5 = [
            'nombre' => 'Framework LangChain',
            'actividades' => [
                [
                    'nombre' => 'Despliegue y Monitoreo de LLMs',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Acceso basado en API (OpenAI, Anthropic, Hugging Face)', 'horas' => 3, 'recurso' => 'OpenAI API, Anthropic API, HF Inference'],
                        ['nombre' => 'Despliegue local de LLMs pequeños (ecosistema Hugging Face)', 'horas' => 3, 'recurso' => 'Hugging Face Local Deployment'],
                        ['nombre' => 'Optimización de costos para uso de LLMs', 'horas' => 3, 'recurso' => 'Cost Optimization Guides'],
                        ['nombre' => 'Consideraciones de latencia y throughput', 'horas' => 3, 'recurso' => 'Performance Optimization'],
                        ['nombre' => 'Detección y mitigación de alucinaciones', 'horas' => 3, 'recurso' => 'Hallucination Detection Papers'],
                    ]
                ],
                [
                    'nombre' => 'Componentes Core de LangChain',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Modelos (LLMs, ChatModels, Embeddings)', 'horas' => 3, 'recurso' => 'LangChain Docs - Models'],
                        ['nombre' => 'Prompts (PromptTemplates, ChatPromptTemplates)', 'horas' => 3, 'recurso' => 'LangChain Docs - Prompts'],
                        ['nombre' => 'Parsers (OutputParsers, PydanticOutputParser)', 'horas' => 3, 'recurso' => 'LangChain Docs - Output Parsers'],
                        ['nombre' => 'Chains (LLMChain, SequentialChain, RetrievalQA)', 'horas' => 6, 'recurso' => 'LangChain Docs - Chains'],
                        ['nombre' => 'Agents y Tools', 'horas' => 3, 'recurso' => 'LangChain Docs - Agents'],
                    ]
                ],
                [
                    'nombre' => 'Construcción de Aplicaciones LLM con LangChain',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Carga y División de Documentos', 'horas' => 3, 'recurso' => 'LangChain Docs - Document Loaders'],
                        ['nombre' => 'Vector Stores y Embeddings para RAG', 'horas' => 6, 'recurso' => 'LangChain Docs - Vector Stores, RAG'],
                        ['nombre' => 'Implementación de pipelines RAG', 'horas' => 6, 'recurso' => 'LangChain RAG Tutorial'],
                        ['nombre' => 'Creación de Tools y Agents personalizados', 'horas' => 3, 'recurso' => 'LangChain Docs - Custom Tools'],
                        ['nombre' => 'Callbacks y Tracing (LangSmith)', 'horas' => 3, 'recurso' => 'LangSmith Docs'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 6: Ingeniería ML y MLOps
        $categoria6 = [
            'nombre' => 'Ingeniería ML y MLOps',
            'actividades' => [
                [
                    'nombre' => 'Técnicas Avanzadas de LangChain',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Desarrollo y composición de Chains personalizados', 'horas' => 3, 'recurso' => 'LangChain Advanced Chains'],
                        ['nombre' => 'Integración de fuentes de datos diversas (bases de datos, APIs)', 'horas' => 3, 'recurso' => 'LangChain Integrations'],
                        ['nombre' => 'Desarrollo de agents autónomos con capacidades de planificación', 'horas' => 6, 'recurso' => 'LangChain Agents, AutoGPT'],
                        ['nombre' => 'Consideraciones de despliegue en producción para apps LangChain', 'horas' => 3, 'recurso' => 'LangChain Production Guide'],
                        ['nombre' => 'Evaluación de aplicaciones LangChain', 'horas' => 3, 'recurso' => 'LangChain Evaluation'],
                    ]
                ],
                [
                    'nombre' => 'Desarrollo de Pipelines de Datos',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Ingesta de datos (APIs, bases de datos, message queues)', 'horas' => 3, 'recurso' => 'Data Ingestion Patterns'],
                        ['nombre' => 'Transformación de datos (ETL/ELT, Spark, Dask)', 'horas' => 6, 'recurso' => 'Apache Spark, Dask Docs'],
                        ['nombre' => 'Validación y calidad de datos (Great Expectations, Deequ)', 'horas' => 3, 'recurso' => 'Great Expectations, Deequ'],
                        ['nombre' => 'Conceptos de Feature Stores (Feast, Tecton)', 'horas' => 3, 'recurso' => 'Feast, Tecton Docs'],
                        ['nombre' => 'Fundamentos de procesamiento de streams (Kafka, Flink)', 'horas' => 6, 'recurso' => 'Apache Kafka, Flink Docs'],
                    ]
                ],
                [
                    'nombre' => 'Despliegue y Servicio de Modelos',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'Desarrollo de APIs RESTful (Flask, FastAPI, Django REST)', 'horas' => 6, 'recurso' => 'FastAPI Docs, Flask Docs'],
                        ['nombre' => 'Containerización (Docker)', 'horas' => 3, 'recurso' => 'Docker Docs, Docker for ML'],
                        ['nombre' => 'Orquestación (Kubernetes básico, Helm)', 'horas' => 6, 'recurso' => 'Kubernetes Docs, Helm Docs'],
                        ['nombre' => 'Versionado y registro de modelos (MLflow, DVC)', 'horas' => 3, 'recurso' => 'MLflow, DVC Docs'],
                        ['nombre' => 'Frameworks de servicio de modelos (MLflow, BentoML, Seldon)', 'horas' => 6, 'recurso' => 'MLflow Serving, BentoML, Seldon'],
                    ]
                ],
                [
                    'nombre' => 'Monitoreo y Mantenimiento',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Monitoreo de rendimiento de modelos (detección de drift, bias)', 'horas' => 6, 'recurso' => 'Evidently AI, Fiddler'],
                        ['nombre' => 'Monitoreo de calidad de datos y alertas', 'horas' => 3, 'recurso' => 'Great Expectations, Data Quality'],
                        ['nombre' => 'Sistemas de logging y alertas (Prometheus, Grafana, ELK)', 'horas' => 6, 'recurso' => 'Prometheus, Grafana, ELK Stack'],
                        ['nombre' => 'A/B testing para comparación de modelos', 'horas' => 3, 'recurso' => 'A/B Testing for ML'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 7: Automatización de Workflows con n8n
        $categoria7 = [
            'nombre' => 'Automatización de Workflows con n8n',
            'actividades' => [
                [
                    'nombre' => 'Fundamentos de n8n',
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Comprensión de nodos y workflows de n8n', 'horas' => 3, 'recurso' => 'n8n Docs, n8n Learn'],
                        ['nombre' => 'Nodos trigger (webhook, cron, triggers específicos de apps)', 'horas' => 3, 'recurso' => 'n8n Triggers'],
                        ['nombre' => 'Nodos core (HTTP Request, Set, If, Merge, Split Batch)', 'horas' => 3, 'recurso' => 'n8n Core Nodes'],
                        ['nombre' => 'Manejo de errores y mecanismos de retry en workflows', 'horas' => 3, 'recurso' => 'n8n Error Handling'],
                    ]
                ],
                [
                    'nombre' => 'Integración de Python con n8n',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Uso y ejecución del nodo de código Python', 'horas' => 3, 'recurso' => 'n8n Python Node'],
                        ['nombre' => 'Pasar datos entre n8n y scripts Python (JSON)', 'horas' => 3, 'recurso' => 'n8n Data Flow'],
                        ['nombre' => 'Ejecutar scripts Python externos vía SSH o API', 'horas' => 3, 'recurso' => 'n8n External Execution'],
                        ['nombre' => 'Utilizar n8n para orquestar pasos de preprocesamiento', 'horas' => 3, 'recurso' => 'n8n Data Pipelines'],
                        ['nombre' => 'Automatizar llamadas de inferencia de modelos ML vía APIs', 'horas' => 3, 'recurso' => 'n8n ML Integration'],
                    ]
                ],
                [
                    'nombre' => 'n8n Avanzado para Automatización ML',
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Construir workflows complejos condicionales y con ramificaciones', 'horas' => 3, 'recurso' => 'n8n Advanced Workflows'],
                        ['nombre' => 'Programar tareas ML y actualizaciones de datos', 'horas' => 3, 'recurso' => 'n8n Scheduling'],
                        ['nombre' => 'Integrar con servicios cloud (AWS S3, Google Sheets, bases de datos)', 'horas' => 3, 'recurso' => 'n8n Cloud Integrations'],
                        ['nombre' => 'Pipelines ML impulsados por webhooks (ej: reentrenamiento)', 'horas' => 3, 'recurso' => 'n8n ML Pipelines'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 8: Principios de Optimización Logística
        $categoria8 = [
            'nombre' => 'Principios de Optimización Logística',
            'actividades' => [
                [
                    'nombre' => 'Fundamentos de Investigación Operativa',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Programación Lineal (LP)', 'horas' => 3, 'recurso' => 'OR-Tools, PuLP Docs'],
                        ['nombre' => 'Programación Lineal Entera (ILP)', 'horas' => 3, 'recurso' => 'OR-Tools, PuLP Docs'],
                        ['nombre' => 'Programación Lineal Mixta-Entera (MILP)', 'horas' => 3, 'recurso' => 'OR-Tools, PuLP Docs'],
                        ['nombre' => 'Formulación de funciones objetivo y restricciones', 'horas' => 3, 'recurso' => 'OR Modeling Guides'],
                        ['nombre' => 'Definición de variables de decisión', 'horas' => 3, 'recurso' => 'OR Modeling Guides'],
                        ['nombre' => 'Fundamentos del algoritmo Simplex', 'horas' => 3, 'recurso' => 'Simplex Algorithm Tutorial'],
                    ]
                ],
                [
                    'nombre' => 'Problemas Comunes de Logística',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Problema del Viajante (TSP) y sus variantes', 'horas' => 3, 'recurso' => 'OR-Tools TSP, TSP Papers'],
                        ['nombre' => 'Problema de Enrutamiento de Vehículos (VRP) y variantes', 'horas' => 6, 'recurso' => 'OR-Tools VRP, VRP Papers'],
                        ['nombre' => 'Problemas de Localización-Asignación (Facility Location)', 'horas' => 3, 'recurso' => 'Facility Location Problems'],
                        ['nombre' => 'Modelos de Gestión de Inventario (EOQ, JIT, análisis ABC)', 'horas' => 3, 'recurso' => 'Inventory Management Models'],
                        ['nombre' => 'Programación de Producción', 'horas' => 3, 'recurso' => 'Production Scheduling'],
                    ]
                ],
                [
                    'nombre' => 'Técnicas de Optimización y Solvers',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Heurísticas y Metaheurísticas (Algoritmos Genéticos, Simulated Annealing)', 'horas' => 6, 'recurso' => 'Metaheuristics Books, DEAP'],
                        ['nombre' => 'Programación por Restricciones', 'horas' => 3, 'recurso' => 'Constraint Programming'],
                        ['nombre' => 'Solvers open-source (PuLP, OR-Tools, SciPy.optimize)', 'horas' => 6, 'recurso' => 'PuLP, OR-Tools, SciPy'],
                        ['nombre' => 'Fundamentos de Programación Dinámica', 'horas' => 3, 'recurso' => 'Dynamic Programming'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 9: Machine Learning para Optimización Logística
        $categoria9 = [
            'nombre' => 'Machine Learning para Optimización Logística',
            'actividades' => [
                [
                    'nombre' => 'Analítica Predictiva en Logística',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Pronóstico de demanda (Análisis de Series Temporales, ARIMA, Prophet)', 'horas' => 6, 'recurso' => 'Prophet, Statsmodels, Time Series'],
                        ['nombre' => 'Mantenimiento predictivo para flotas de vehículos', 'horas' => 3, 'recurso' => 'Predictive Maintenance ML'],
                        ['nombre' => 'Predicción de niveles de inventario y prevención de desabastecimiento', 'horas' => 3, 'recurso' => 'Inventory Forecasting'],
                        ['nombre' => 'Predicción de retrasos en envíos y estimación de ETA', 'horas' => 3, 'recurso' => 'ETA Prediction ML'],
                        ['nombre' => 'Estimación de tiempo de ruta basada en factores en tiempo real', 'horas' => 3, 'recurso' => 'Route Time Estimation'],
                        ['nombre' => 'Predicción de churn de clientes en servicios logísticos', 'horas' => 3, 'recurso' => 'Churn Prediction'],
                    ]
                ],
                [
                    'nombre' => 'Optimización con Entradas ML',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Usar predicciones ML como entradas para modelos OR', 'horas' => 6, 'recurso' => 'ML-OR Integration'],
                        ['nombre' => 'Reinforcement Learning para enrutamiento y despacho dinámico', 'horas' => 6, 'recurso' => 'RL for Logistics, RLlib'],
                        ['nombre' => 'Detección de anomalías en datos logísticos', 'horas' => 3, 'recurso' => 'Anomaly Detection'],
                        ['nombre' => 'Analítica prescriptiva combinando ML y modelos OR', 'horas' => 3, 'recurso' => 'Prescriptive Analytics'],
                    ]
                ],
                [
                    'nombre' => 'Estudios de Caso y Aplicaciones',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Optimización de rutas y horarios de última milla', 'horas' => 3, 'recurso' => 'Last-Mile Optimization'],
                        ['nombre' => 'Optimización de layout de almacén y rutas de picking', 'horas' => 3, 'recurso' => 'Warehouse Optimization'],
                        ['nombre' => 'Gestión de flotas y programación de mantenimiento', 'horas' => 3, 'recurso' => 'Fleet Management'],
                        ['nombre' => 'Gestión de riesgos y resiliencia de cadena de suministro', 'horas' => 3, 'recurso' => 'Supply Chain Risk'],
                        ['nombre' => 'Estrategias de precios dinámicos en logística', 'horas' => 3, 'recurso' => 'Dynamic Pricing'],
                        ['nombre' => 'Asignación de recursos en redes de transporte complejas', 'horas' => 3, 'recurso' => 'Resource Allocation'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 10: Computación en la Nube para ML y Automatización
        $categoria10 = [
            'nombre' => 'Computación en la Nube para ML y Automatización',
            'actividades' => [
                [
                    'nombre' => 'Fundamentos de Cloud (AWS, GCP, Azure)',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Servicios de cómputo (EC2, Cloud Run, Azure Container Instances)', 'horas' => 6, 'recurso' => 'AWS EC2, GCP Cloud Run, Azure Docs'],
                        ['nombre' => 'Servicios de almacenamiento (S3, GCS, Azure Blob Storage)', 'horas' => 3, 'recurso' => 'AWS S3, GCP GCS, Azure Blob'],
                        ['nombre' => 'Servicios de bases de datos (RDS, Cloud SQL, Cosmos DB)', 'horas' => 3, 'recurso' => 'AWS RDS, GCP Cloud SQL, Azure Cosmos'],
                        ['nombre' => 'Fundamentos de networking (VPC, subnets, security groups)', 'horas' => 3, 'recurso' => 'AWS VPC, GCP VPC, Azure VNet'],
                        ['nombre' => 'Identity and Access Management (IAM)', 'horas' => 3, 'recurso' => 'AWS IAM, GCP IAM, Azure AD'],
                        ['nombre' => 'Gestión de costos y optimización de facturación', 'horas' => 3, 'recurso' => 'Cloud Cost Optimization'],
                    ]
                ],
                [
                    'nombre' => 'Servicios ML en Cloud',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'AWS SageMaker (entrenamiento, hosting, notebooks)', 'horas' => 6, 'recurso' => 'AWS SageMaker Docs'],
                        ['nombre' => 'Google Cloud Vertex AI (datasets, modelos, endpoints gestionados)', 'horas' => 6, 'recurso' => 'Vertex AI Docs'],
                        ['nombre' => 'Azure Machine Learning (workspace, experimentos, pipelines)', 'horas' => 6, 'recurso' => 'Azure ML Docs'],
                    ]
                ],
                [
                    'nombre' => 'Serverless y Orquestación de Contenedores',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'AWS Lambda, Cloud Functions, Azure Functions para tareas event-driven', 'horas' => 6, 'recurso' => 'AWS Lambda, GCP Functions, Azure Functions'],
                        ['nombre' => 'AWS Fargate, GKE, AKS', 'horas' => 6, 'recurso' => 'AWS Fargate, GKE, AKS Docs'],
                        ['nombre' => 'Container Registry (ECR, GCR, ACR)', 'horas' => 3, 'recurso' => 'ECR, GCR, ACR Docs'],
                        ['nombre' => 'Infrastructure as Code (Terraform, CloudFormation)', 'horas' => 3, 'recurso' => 'Terraform, CloudFormation'],
                    ]
                ],
            ]
        ];

        // CATEGORÍA 11: Gestión de Proyectos e IA Ética
        $categoria11 = [
            'nombre' => 'Gestión de Proyectos e IA Ética',
            'actividades' => [
                [
                    'nombre' => 'Metodologías Ágiles para Proyectos ML',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Framework Scrum para equipos ML', 'horas' => 3, 'recurso' => 'Scrum Guide, ML Scrum'],
                        ['nombre' => 'Kanban para visualización y gestión de workflows', 'horas' => 3, 'recurso' => 'Kanban Guide'],
                        ['nombre' => 'User story mapping para features ML', 'horas' => 3, 'recurso' => 'User Story Mapping'],
                        ['nombre' => 'Sprints y ciclos de desarrollo iterativo', 'horas' => 3, 'recurso' => 'Agile Sprints'],
                        ['nombre' => 'Gestión de backlog y priorización', 'horas' => 3, 'recurso' => 'Backlog Management'],
                    ]
                ],
                [
                    'nombre' => 'Ciclo de Vida de Proyectos ML',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Definición de problema y clarificación de alcance', 'horas' => 3, 'recurso' => 'ML Project Planning'],
                        ['nombre' => 'Recolección, limpieza y preparación de datos', 'horas' => 3, 'recurso' => 'Data Preparation'],
                        ['nombre' => 'Desarrollo, entrenamiento y evaluación de modelos', 'horas' => 6, 'recurso' => 'Model Development'],
                        ['nombre' => 'Despliegue, integración y MLOps', 'horas' => 3, 'recurso' => 'MLOps Guide'],
                        ['nombre' => 'Monitoreo, mantenimiento y reentrenamiento', 'horas' => 3, 'recurso' => 'Model Monitoring'],
                    ]
                ],
                [
                    'nombre' => 'IA Ética y ML Responsable',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Sesgo y equidad en sistemas de IA (detección, mitigación)', 'horas' => 6, 'recurso' => 'Fairness in ML, AIF360'],
                        ['nombre' => 'Transparencia e interpretabilidad de modelos (LIME, SHAP)', 'horas' => 6, 'recurso' => 'LIME, SHAP, Interpretability'],
                        ['nombre' => 'Preocupaciones de privacidad (GDPR, CCPA, privacidad diferencial)', 'horas' => 3, 'recurso' => 'Privacy in ML, GDPR'],
                        ['nombre' => 'Seguridad de datos y gobernanza', 'horas' => 3, 'recurso' => 'Data Governance'],
                    ]
                ],
            ]
        ];

        // Agrupar todas las categorías
        $categorias = [
            $categoria1, $categoria2, $categoria3, $categoria4, $categoria5,
            $categoria6, $categoria7, $categoria8, $categoria9, $categoria10, $categoria11
        ];

        // Crear actividades y subactividades
        $fechaActual = $fechaInicio->copy();
        $horasAcumuladas = 0;

        foreach ($categorias as $categoria) {
            foreach ($categoria['actividades'] as $actividadData) {
                // Calcular fechas para la actividad
                $horasActividad = $actividadData['horas'];
                $semanasNecesarias = ceil($horasActividad / $horasSemanales);
                $diasNecesarios = $semanasNecesarias * 7;
                $fechaInicioActividad = $fechaActual->copy();
                $fechaFinActividad = $fechaActual->copy()->addDays($diasNecesarios - 1);

                // Crear actividad
                $actividad = Actividad::create([
                    'nombre' => $actividadData['nombre'],
                    'descripcion' => "Categoría: {$categoria['nombre']}. " . 
                                   "Horas totales: {$horasActividad}h. " .
                                   "Recursos: " . implode(', ', array_unique(array_column($actividadData['subactividades'], 'recurso'))),
                    'fecha_inicio' => $fechaInicioActividad,
                    'fecha_fin' => $fechaFinActividad,
                    'progreso' => 0,
                    'estado' => 'pendiente',
                    'prioridad' => $this->determinarPrioridad($categoria['nombre']),
                    'color' => $this->obtenerColor($categoria['nombre']),
                ]);

                // Crear subactividades - distribuir dentro del rango de la actividad padre
                $diasTotalesActividad = $fechaInicioActividad->diffInDays($fechaFinActividad) + 1;
                $horasTotalesSubactividades = array_sum(array_column($actividadData['subactividades'], 'horas'));
                
                // Calcular proporción de días por hora para distribuir las subactividades
                $diasPorHora = $horasTotalesSubactividades > 0 ? $diasTotalesActividad / $horasTotalesSubactividades : 1;
                
                $fechaSubActual = $fechaInicioActividad->copy();

                foreach ($actividadData['subactividades'] as $index => $subactividadData) {
                    $horasSub = $subactividadData['horas'];
                    // Calcular días proporcionales basados en las horas
                    $diasSub = max(1, (int) round($horasSub * $diasPorHora));
                    
                    // Asegurar que no se exceda el rango de la actividad padre
                    $fechaInicioSub = $fechaSubActual->copy();
                    $fechaFinSub = min(
                        $fechaSubActual->copy()->addDays($diasSub - 1),
                        $fechaFinActividad->copy()
                    );
                    
                    // Si la fecha de fin excede el rango de la actividad, ajustarla
                    if ($fechaFinSub->gt($fechaFinActividad)) {
                        $fechaFinSub = $fechaFinActividad->copy();
                    }
                    
                    // Si la fecha de inicio es después de la fecha fin de la actividad, ajustar
                    if ($fechaInicioSub->gt($fechaFinActividad)) {
                        $fechaInicioSub = $fechaFinActividad->copy();
                        $fechaFinSub = $fechaFinActividad->copy();
                    }

                    Subactividad::create([
                        'actividad_id' => $actividad->id,
                        'nombre' => $subactividadData['nombre'],
                        'descripcion' => "Horas estimadas: {$horasSub}h. Recurso: {$subactividadData['recurso']}",
                        'fecha_inicio' => $fechaInicioSub,
                        'fecha_fin' => $fechaFinSub,
                        'progreso' => 0,
                        'estado' => 'pendiente',
                        'orden' => $index + 1,
                    ]);

                    // Avanzar al día siguiente después de la fecha fin de esta subactividad
                    $fechaSubActual = $fechaFinSub->copy()->addDay();
                    
                    // Si ya llegamos al final del rango de la actividad, detener
                    if ($fechaSubActual->gt($fechaFinActividad)) {
                        break;
                    }
                }

                $fechaActual = $fechaFinActividad->copy()->addDay();
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

        $this->command->info('✅ Se ha creado el roadmap de "Machine Learning Engineer"');
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
            'Deep Learning para NLP' => 'alta',
            'LLMs y Prompt Engineering' => 'alta',
            'Framework LangChain' => 'alta',
            'Ingeniería ML y MLOps' => 'alta',
            'Automatización de Workflows con n8n' => 'media',
            'Principios de Optimización Logística' => 'media',
            'Machine Learning para Optimización Logística' => 'media',
            'Computación en la Nube' => 'alta',
            'Gestión de Proyectos e IA Ética' => 'media',
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
            'Deep Learning para NLP' => '#8b5cf6',
            'LLMs y Prompt Engineering' => '#f59e0b',
            'Framework LangChain' => '#ef4444',
            'Ingeniería ML y MLOps' => '#3b82f6',
            'Automatización de Workflows' => '#ec4899',
            'Optimización Logística' => '#14b8a6',
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
