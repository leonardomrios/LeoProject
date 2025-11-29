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

        // CATEGORÍA 1: Fundamentos de Python y Configuración del Entorno
        $categoria1 = [
            'nombre' => 'Fundamentos de Python y Configuración del Entorno',
            'actividades' => [
                [
                    'nombre' => 'Programación Core de Python',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Estructuras de Datos (listas, diccionarios, sets, tuplas)', 'horas' => 2, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Control de Flujo (if/else, loops, comprehensions)', 'horas' => 2, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Funciones, Generadores y Decoradores', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Programación Orientada a Objetos (clases, herencia)', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'Manejo de Errores y Debugging', 'horas' => 2, 'recurso' => 'Python.org docs, Real Python'],
                        ['nombre' => 'File I/O y Context Managers', 'horas' => 3, 'recurso' => 'Python.org docs, Real Python'],
                    ]
                ],
                [
                    'nombre' => 'Stack Científico de Python',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'NumPy para computación numérica', 'horas' => 3, 'recurso' => 'NumPy.org, NumPy User Guide'],
                        ['nombre' => 'Pandas para manipulación y análisis de datos', 'horas' => 6, 'recurso' => 'Pandas.pydata.org, 10 Minutes to Pandas'],
                        ['nombre' => 'Matplotlib y Seaborn para visualización', 'horas' => 3, 'recurso' => 'Matplotlib.org, Seaborn.pydata.org'],
                        ['nombre' => 'Fundamentos de Scikit-learn', 'horas' => 3, 'recurso' => 'Scikit-learn.org, Getting Started'],
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
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Git y GitHub para control de versiones', 'horas' => 3, 'recurso' => 'Git-scm.com, GitHub Docs'],
                        ['nombre' => 'IDEs (VS Code, PyCharm)', 'horas' => 2, 'recurso' => 'VS Code Docs, PyCharm Guide'],
                        ['nombre' => 'Frameworks de testing (pytest)', 'horas' => 2, 'recurso' => 'Pytest.org'],
                        ['nombre' => 'Estilo de código (PEP 8, Black)', 'horas' => 2, 'recurso' => 'PEP 8, Black docs'],
                        ['nombre' => 'Gestión de paquetes (pip, poetry)', 'horas' => 2, 'recurso' => 'Pip docs, Poetry docs'],
                        ['nombre' => 'Práctica: Configurar proyecto ML completo', 'horas' => 4, 'recurso' => 'Proyecto práctico'],
                    ]
                ],
                [
                    'nombre' => 'Aprendizaje Supervisado',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Regresión (Lineal, Ridge, Lasso)', 'horas' => 4, 'recurso' => 'Scikit-learn Regression, ISLR Book'],
                        ['nombre' => 'Clasificación (Logística, SVM, Árboles, Random Forests)', 'horas' => 6, 'recurso' => 'Scikit-learn Classification, ISLR Book'],
                        ['nombre' => 'Métricas de Evaluación (Accuracy, Precision, Recall, F1, RMSE, R2)', 'horas' => 3, 'recurso' => 'Scikit-learn Metrics'],
                        ['nombre' => 'Cross-validation y validación de modelos', 'horas' => 4, 'recurso' => 'Scikit-learn Cross-validation'],
                        ['nombre' => 'Trade-off Bias-Varianza y overfitting', 'horas' => 4, 'recurso' => 'ISLR Book, ML Theory'],
                    ]
                ],
                [
                    'nombre' => 'Aprendizaje No Supervisado',
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Clustering (K-Means, DBSCAN)', 'horas' => 4, 'recurso' => 'Scikit-learn Clustering'],
                        ['nombre' => 'Reducción de Dimensionalidad (PCA, t-SNE)', 'horas' => 4, 'recurso' => 'Scikit-learn Dimensionality Reduction'],
                        ['nombre' => 'Detección de Anomalías', 'horas' => 4, 'recurso' => 'Scikit-learn Anomaly Detection'],
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
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Redes Neuronales Feedforward (conceptos básicos)', 'horas' => 3, 'recurso' => 'Deep Learning Book, Fast.ai'],
                        ['nombre' => 'Backpropagation y optimización (SGD, Adam)', 'horas' => 3, 'recurso' => 'Deep Learning Book'],
                        ['nombre' => 'Regularización (Dropout, Batch Normalization)', 'horas' => 3, 'recurso' => 'Deep Learning Book'],
                        ['nombre' => 'PyTorch: Fundamentos y tensores', 'horas' => 4, 'recurso' => 'PyTorch Tutorials, PyTorch Docs'],
                        ['nombre' => 'PyTorch: Construcción y entrenamiento de modelos', 'horas' => 5, 'recurso' => 'PyTorch Tutorials'],
                    ]
                ],
                [
                    'nombre' => 'Modelos Transformer y LLMs',
                    'horas' => 24,
                    'subactividades' => [
                        ['nombre' => 'Arquitectura Transformer: Self-attention y Multi-head attention', 'horas' => 4, 'recurso' => 'Attention Is All You Need Paper, Illustrated Transformer'],
                        ['nombre' => 'BERT y modelos encoder (RoBERTa, DistilBERT)', 'horas' => 4, 'recurso' => 'Hugging Face Transformers, BERT Paper'],
                        ['nombre' => 'GPT y modelos generativos (GPT-2, GPT-3)', 'horas' => 4, 'recurso' => 'Hugging Face Transformers, GPT Papers'],
                        ['nombre' => 'Hugging Face: Uso de modelos pre-entrenados', 'horas' => 4, 'recurso' => 'Hugging Face Course, Transformers Docs'],
                        ['nombre' => 'Fine-tuning de modelos pre-entrenados', 'horas' => 4, 'recurso' => 'Hugging Face Course, Fine-tuning Guide'],
                        ['nombre' => 'Conceptos de LLMs: Pre-training, fine-tuning, RLHF', 'horas' => 4, 'recurso' => 'RLHF Papers, Hugging Face'],
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
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'Conceptos fundamentales de RAG', 'horas' => 3, 'recurso' => 'RAG Papers, LangChain RAG Guide'],
                        ['nombre' => 'Embeddings y modelos de embeddings (OpenAI, Sentence-BERT)', 'horas' => 4, 'recurso' => 'OpenAI Embeddings, Sentence-Transformers'],
                        ['nombre' => 'Vector Stores (Pinecone, Weaviate, FAISS, Chroma)', 'horas' => 4, 'recurso' => 'Pinecone Docs, Weaviate, FAISS, Chroma'],
                        ['nombre' => 'Carga y procesamiento de documentos (chunking, splitting)', 'horas' => 3, 'recurso' => 'LangChain Document Loaders'],
                        ['nombre' => 'Implementación de pipeline RAG completo', 'horas' => 4, 'recurso' => 'LangChain RAG Tutorial, RAG Best Practices'],
                        ['nombre' => 'Optimización de RAG: Query expansion, re-ranking', 'horas' => 3, 'recurso' => 'RAG Optimization Techniques'],
                    ]
                ],
                [
                    'nombre' => 'Prompt Engineering y Aplicaciones LLM',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Técnicas de Prompt Engineering (zero-shot, few-shot, CoT)', 'horas' => 4, 'recurso' => 'OpenAI Prompt Engineering Guide, CoT Paper'],
                        ['nombre' => 'Aplicaciones LLM: Clasificación de texto, NER, QA', 'horas' => 3, 'recurso' => 'Hugging Face Tasks'],
                        ['nombre' => 'Aplicaciones LLM: Resumen, traducción, generación', 'horas' => 3, 'recurso' => 'Hugging Face Tasks'],
                        ['nombre' => 'Evaluación de modelos LLM (métricas, benchmarks)', 'horas' => 3, 'recurso' => 'LLM Evaluation Papers, HELM'],
                        ['nombre' => 'Mitigación de alucinaciones y seguridad en LLMs', 'horas' => 2, 'recurso' => 'Hallucination Detection, LLM Safety'],
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
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Modelos (LLMs, ChatModels, Embeddings)', 'horas' => 3, 'recurso' => 'LangChain Docs - Models'],
                        ['nombre' => 'Prompts (PromptTemplates, ChatPromptTemplates)', 'horas' => 3, 'recurso' => 'LangChain Docs - Prompts'],
                        ['nombre' => 'Chains (LLMChain, SequentialChain)', 'horas' => 4, 'recurso' => 'LangChain Docs - Chains'],
                        ['nombre' => 'Agents y Tools', 'horas' => 3, 'recurso' => 'LangChain Docs - Agents'],
                        ['nombre' => 'Memory (ConversationBufferMemory)', 'horas' => 2, 'recurso' => 'LangChain Docs - Memory'],
                    ]
                ],
                [
                    'nombre' => 'RAG con LangChain',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'Document Loaders y Splitters', 'horas' => 3, 'recurso' => 'LangChain Docs - Document Loaders'],
                        ['nombre' => 'Vector Stores en LangChain (Chroma, Pinecone, FAISS)', 'horas' => 4, 'recurso' => 'LangChain Docs - Vector Stores'],
                        ['nombre' => 'Retrievers y técnicas de recuperación', 'horas' => 3, 'recurso' => 'LangChain Docs - Retrievers'],
                        ['nombre' => 'Implementación de RAG pipeline completo', 'horas' => 5, 'recurso' => 'LangChain RAG Tutorial'],
                        ['nombre' => 'Evaluación y optimización de sistemas RAG', 'horas' => 3, 'recurso' => 'LangChain Evaluation, RAG Evaluation'],
                    ]
                ],
                [
                    'nombre' => 'Aplicaciones Avanzadas con LangChain',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Agents autónomos con herramientas personalizadas', 'horas' => 5, 'recurso' => 'LangChain Agents, AutoGPT'],
                        ['nombre' => 'Integración con bases de datos y APIs', 'horas' => 4, 'recurso' => 'LangChain Integrations'],
                        ['nombre' => 'Chains personalizados y composición', 'horas' => 3, 'recurso' => 'LangChain Advanced Chains'],
                        ['nombre' => 'Despliegue de aplicaciones LangChain en producción', 'horas' => 3, 'recurso' => 'LangChain Production Guide'],
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
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Ingesta de datos (APIs, bases de datos, archivos)', 'horas' => 3, 'recurso' => 'Data Ingestion Patterns'],
                        ['nombre' => 'Transformación de datos (ETL básico)', 'horas' => 3, 'recurso' => 'ETL Patterns'],
                        ['nombre' => 'Validación de datos (Great Expectations básico)', 'horas' => 3, 'recurso' => 'Great Expectations'],
                        ['nombre' => 'Feature Engineering y selección de características', 'horas' => 3, 'recurso' => 'Feature Engineering Guide'],
                        ['nombre' => 'Conceptos de Feature Stores (Feast)', 'horas' => 3, 'recurso' => 'Feast Docs'],
                    ]
                ],
                [
                    'nombre' => 'Despliegue y Servicio de Modelos',
                    'horas' => 21,
                    'subactividades' => [
                        ['nombre' => 'APIs RESTful para ML (FastAPI)', 'horas' => 6, 'recurso' => 'FastAPI Docs, FastAPI for ML'],
                        ['nombre' => 'Containerización con Docker', 'horas' => 3, 'recurso' => 'Docker Docs, Docker for ML'],
                        ['nombre' => 'Versionado de modelos (MLflow)', 'horas' => 4, 'recurso' => 'MLflow Docs'],
                        ['nombre' => 'Serving de modelos (MLflow, BentoML)', 'horas' => 4, 'recurso' => 'MLflow Serving, BentoML'],
                        ['nombre' => 'Kubernetes básico para ML', 'horas' => 4, 'recurso' => 'Kubernetes Docs, ML on K8s'],
                    ]
                ],
                [
                    'nombre' => 'Monitoreo y Mantenimiento',
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Monitoreo de modelos en producción (drift, performance)', 'horas' => 5, 'recurso' => 'Evidently AI, MLflow Monitoring'],
                        ['nombre' => 'Logging y observabilidad (Prometheus, Grafana básico)', 'horas' => 4, 'recurso' => 'Prometheus, Grafana'],
                        ['nombre' => 'A/B testing para modelos', 'horas' => 3, 'recurso' => 'A/B Testing for ML'],
                        ['nombre' => 'Estrategias de reentrenamiento', 'horas' => 3, 'recurso' => 'Model Retraining Strategies'],
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
                    'horas' => 15,
                    'subactividades' => [
                        ['nombre' => 'Servicios de cómputo (EC2, Cloud Run)', 'horas' => 4, 'recurso' => 'AWS EC2, GCP Cloud Run'],
                        ['nombre' => 'Servicios de almacenamiento (S3, GCS)', 'horas' => 3, 'recurso' => 'AWS S3, GCP GCS'],
                        ['nombre' => 'Servicios de bases de datos (RDS, Cloud SQL)', 'horas' => 3, 'recurso' => 'AWS RDS, GCP Cloud SQL'],
                        ['nombre' => 'Networking básico (VPC, security groups)', 'horas' => 3, 'recurso' => 'AWS VPC, GCP VPC'],
                        ['nombre' => 'IAM y seguridad básica', 'horas' => 2, 'recurso' => 'AWS IAM, GCP IAM'],
                    ]
                ],
                [
                    'nombre' => 'Servicios ML en Cloud',
                    'horas' => 18,
                    'subactividades' => [
                        ['nombre' => 'AWS SageMaker (entrenamiento, hosting)', 'horas' => 6, 'recurso' => 'AWS SageMaker Docs'],
                        ['nombre' => 'Google Cloud Vertex AI (datasets, modelos, endpoints)', 'horas' => 6, 'recurso' => 'Vertex AI Docs'],
                        ['nombre' => 'Serverless para ML (Lambda, Cloud Functions)', 'horas' => 3, 'recurso' => 'AWS Lambda, GCP Functions'],
                        ['nombre' => 'Containerización en cloud (ECR, GCR)', 'horas' => 3, 'recurso' => 'ECR, GCR Docs'],
                    ]
                ],
                [
                    'nombre' => 'Infrastructure as Code y CI/CD',
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Terraform básico para infraestructura ML', 'horas' => 4, 'recurso' => 'Terraform Docs, Terraform for ML'],
                        ['nombre' => 'CI/CD para ML (GitHub Actions)', 'horas' => 5, 'recurso' => 'GitHub Actions, ML CI/CD'],
                        ['nombre' => 'Pipelines automatizados de ML', 'horas' => 3, 'recurso' => 'ML Pipelines, GitHub Actions'],
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
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Definición de problema y alcance', 'horas' => 2, 'recurso' => 'ML Project Planning'],
                        ['nombre' => 'Recolección y preparación de datos', 'horas' => 3, 'recurso' => 'Data Preparation'],
                        ['nombre' => 'Desarrollo y evaluación de modelos', 'horas' => 4, 'recurso' => 'Model Development'],
                        ['nombre' => 'Despliegue y MLOps', 'horas' => 3, 'recurso' => 'MLOps Guide'],
                    ]
                ],
                [
                    'nombre' => 'IA Ética y ML Responsable',
                    'horas' => 12,
                    'subactividades' => [
                        ['nombre' => 'Sesgo y equidad en ML (detección, mitigación)', 'horas' => 4, 'recurso' => 'Fairness in ML, AIF360'],
                        ['nombre' => 'Interpretabilidad de modelos (LIME, SHAP)', 'horas' => 4, 'recurso' => 'LIME, SHAP, Interpretability'],
                        ['nombre' => 'Privacidad y seguridad de datos (GDPR básico)', 'horas' => 2, 'recurso' => 'Privacy in ML, GDPR'],
                        ['nombre' => 'Responsabilidad y gobernanza de IA', 'horas' => 2, 'recurso' => 'AI Governance'],
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
