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

    public function test_can_update_article()
    {
        // Crear un artículo de prueba en la base de datos utilizando la factoría ArticleFactory
        $article = ArticleFactory::new()->create();

        // Generar datos actualizados utilizando Faker
        $updatedData = [
            'title' => 'Updated Title',
            'body' => 'Updated body content',
            'date' => now()->format('Y-m-d'),
            'id_category' => 1, // Asumiendo que la categoría existe con el id 1
            'image' => 'updated_image.jpg'
        ];

        // Realizar una solicitud HTTP para actualizar el artículo existente
        $response = $this->put(action('ArticleController@update', ['id' => $article->id]), $updatedData);

        // Verificar que la actualización se realizó correctamente y que la respuesta tiene el estado 200
        $response->assertStatus(200);

        // Verificar que los datos actualizados estén presentes en la base de datos utilizando assertDatabaseHas
        $this->assertDatabaseHas('articles', $updatedData);
    }

    public function testDestroy()
    {
        $article = Article::factory()->create();

        $response = $this->delete('/api/articles/' . $article->id);
        $response->assertStatus(200)
            ->assertJson(['message' => 'Artículo eliminado correctamente']);
    }
}
