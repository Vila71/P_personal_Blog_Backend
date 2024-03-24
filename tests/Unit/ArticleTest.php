<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use App\Models\Category;
use Database\Factories\ArticleFactory;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    public function testIndex()
    {
        // Simula una solicitud GET a la ruta del controlador
        $response = $this->get('/api/articles');

        // Asegúrate de que la respuesta tenga el código de estado 200 (OK)
        $response->assertStatus(200);

        // Asegúrate de que la respuesta sea JSON
        $response->assertJson([]);

        // Asegúrate de que la respuesta contenga los artículos
        $responseData = $response->json();
        $this->assertArrayHasKey('articles', $responseData);
        $this->assertNotNull($responseData['articles']);

        // Asegúrate de que 'articles' sea una instancia de la colección Eloquent
        $articles = $responseData['articles'];
        $this->assertIsArray($articles);
        $this->assertGreaterThanOrEqual(0, count($articles));
    }
    public function testShow()
    {
        $article = Article::factory()->create();

        $response = $this->get('/api/articles/' . $article->id);
        $response->assertStatus(200)->assertJsonStructure(['article']);
            
    }

    public function test_can_create_article()
    {
        // Generar datos utilizando la factoría ArticleFactory
        $data = ArticleFactory::new()->raw();

        // Realizar una solicitud HTTP para crear un nuevo artículo
        $response = $this->post('/api/articles', $data);

        // Verificar que la creación se realizó correctamente y que la respuesta tiene la estructura JSON esperada
        $response->assertStatus(201)->assertJsonStructure(['article']);
    }

    public function testUpdate()
    {
        // Crear una instancia de Article usando la factoría
        $article = Article::factory()->create();
    
        // Comprobar que el artículo se ha creado correctamente
        $this->assertDatabaseHas('articles', ['id' => $article->id]);
    
        // Datos nuevos para actualizar el artículo
        $newData = [
            'title' => $this->faker->sentence,
            'body' => $this->faker->text(250),
            'date' => now(),
            'id_category' => Category::factory()->create()->id, // Crear una nueva categoría
            'image' => $this->faker->url(),
        ];
    
        // Hacer la petición PUT a la ruta de actualización
        $response = $this->put('/api/articles/' . $article->id, $newData);
    
        // Asegurarse de que la respuesta tiene estado 200 y contiene los nuevos datos
        $response->assertStatus(200)
            ->assertJsonFragment($newData);
    }
    public function testDestroy()
    {
        $article = Article::factory()->create();

        $response = $this->delete('/api/articles/' . $article->id);
        $response->assertStatus(200)
            ->assertJson(['message' => 'Artículo eliminado correctamente']);
    }
}
