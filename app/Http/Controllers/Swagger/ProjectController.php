<?php

namespace App\Http\Controllers\Swagger;
use App\Http\Controllers\Controller;

/**
 * 
 * @OA\Post(
 *      path="/api/projects",
 *      summary="Создание проекта",
 *      tags={"Projects"},
 * 
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="name",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="product",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="client",
 *                      oneOf={
 *                     	    @OA\Schema(type="string"),
 *                     	    @OA\Schema(type="null")
 *                      }
 *                  ),
 *                  @OA\Property(
 *                      property="year",
 *                      type="integer"
 *                  ),
 *                   example={"name": "WebSite", "product": "some product", "client": "Petr", "year": 2020}                 
 *              )
 *          )    
 *      ),
 * 
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="data", type="object", 
*                   @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="product", type="string"),
 *                  @OA\Property(property="client", oneOf={@OA\Schema(type="string"), @OA\Schema(type="null")}),
 *                  @OA\Property(property="year", type="string"),
 *                  example={"id": 1, "name": "WebSite", "product": "some product", "client": "Petr", "year": 2020}
 *              ),  
 *               @OA\Property(property="message", type="string", example="Project Created Successfully")
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Unprocessable Content",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=422),
 *              @OA\Property(property="errors", type="object",
 *                  @OA\Property(property="name", type="array",
 *                      @OA\Items(type="string", example="The product field must be at least 3 characters.")
 *                  )    
 *              )
 *              
 *          )  
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Server is unable to process a request",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=500),
 *              @OA\Property(property="message", type="string", example="Server is unable to process a request")
 *          )  
 *      ),
 * ),
 * @OA\Get(
 *      path="/api/projects",
 *      summary="Список проектов",
 *      tags={"Projects"},
 * 
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="data", type="array", @OA\Items(
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="product", type="string"),
 *                  @OA\Property(property="client", oneOf={@OA\Schema(type="string"), @OA\Schema(type="null")}),
 *                  @OA\Property(property="year", type="string"),
 *                  example={"id": 1, "name": "WebSite", "product": "some product", "client": "Petr", "year": 2020}    
 *              ))   
 *                 
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="No Records Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=500),
 *              @OA\Property(property="message", type="string", example="No Records Found")
 *          )  
 *      ),
 *  ),
 * @OA\Get(
 *      path="/api/projects/{project}",
 *      summary="Получение проекта по id",
 *      tags={"Projects"},
 *      @OA\Parameter(
 *          description="Id проекта",
 *          in="path",
 *          name="project",
 *          required=true,
 *          example=1
 *      ),
 *  
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="data", type="object", 
*                   @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="product", type="string"),
 *                  @OA\Property(property="client", oneOf={@OA\Schema(type="string"), @OA\Schema(type="null")}),
 *                  @OA\Property(property="year", type="string"),
 *                  example={"id": 1, "name": "WebSite", "product": "some product", "client": "Petr", "year": 2020}
 *              ),  
 *               @OA\Property(property="message", type="string", example="The project was found successfully")
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="No Records Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=404),
 *              @OA\Property(property="message", type="string", example="No Records Found")
 *          )  
 *      ),
 *  ),
 * @OA\Get(
 *      path="/api/projects/{project}/edit",
 *      summary="Получение проекта по id для редактирования",
 *      tags={"Projects"},
 *      @OA\Parameter(
 *          description="Id проекта",
 *          in="path",
 *          name="project",
 *          required=true,
 *          example=1
 *      ),
 *  
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="data", type="object", 
*                   @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="product", type="string"),
 *                  @OA\Property(property="client", oneOf={@OA\Schema(type="string"), @OA\Schema(type="null")}),
 *                  @OA\Property(property="year", type="string"),
 *                  example={"id": 1, "name": "WebSite", "product": "some product", "client": "Petr", "year": 2020}
 *              ),  
 *               @OA\Property(property="message", type="string", example="The project was found successfully")
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="No Records Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=404),
 *              @OA\Property(property="message", type="string", example="No Records Found")
 *          )  
 *      ),
 *  ),
 * @OA\Put(
 *      path="/api/projects/{project}",
 *      summary="Обновление проекта оп id",
 *      tags={"Projects"},
 * 
 *      @OA\Parameter(
 *          description="Id проекта",
 *          in="path",
 *          name="project",
 *          required=true,
 *          example=1
 *      ),
 * 
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="name",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="product",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="client",
 *                      oneOf={
 *                     	    @OA\Schema(type="string"),
 *                     	    @OA\Schema(type="null")
 *                      }
 *                  ),
 *                  @OA\Property(
 *                      property="year",
 *                      type="integer"
 *                  ),
 *                   example={"name": "WebSite", "product": "some product", "client": "Petr", "year": 2020}                 
 *              )
 *          )    
 *      ),
 * 
 *      @OA\Response(
 *          response=200,
 *          description="Project Updated successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="message", type="string", example="Project Updated successfully")
 *          )  
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Unprocessable Content",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=422),
 *              @OA\Property(property="errors", type="object",
 *                  @OA\Property(property="name", type="array",
 *                      @OA\Items(type="string", example="The product field must be at least 3 characters.")
 *                  )    
 *              )
 *              
 *          )  
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="No Records Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=404),
 *              @OA\Property(property="message", type="string", example="No Records Found")
 *          )  
 *      ),
 * ),
 * @OA\Delete(
 *      path="/api/projects/{project}",
 *      summary="Удаление проекта по id",
 *      tags={"Projects"},
 *      @OA\Parameter(
 *          description="Id проекта",
 *          in="path",
 *          name="project",
 *          required=true,
 *          example=1
 *      ),
 *  
 *     @OA\Response(
 *          response=200,
 *          description="Project Deleted successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="message", type="string", example="Project Deleted successfully")
 *          )  
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="The project under this id was not found!",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=404),
 *              @OA\Property(property="message", type="string", example="The project under this id was not found!")
 *          )  
 *      ),
 *  ),
 * 
 * 
 */
class ProjectController extends Controller
{
   
}
