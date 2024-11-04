<?php

namespace App\Http\Controllers;

use App\Entities\Item;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // データベースから全てのアイテムを取得
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $items = $itemRepository->findAll();

        // itemsビューにデータを渡して表示
        return view('items.index', ['items' => $items]);
    }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
       return view('items.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'count' => 'required|integer'
        ]);

        $item = new Item();
        $item->setItemName($validated['item_name']);
        $item->setAmount($validated['amount']);
        $item->setCount($validated['count']);

        $this->entityManager->persist($item);
        $this->entityManager->flush();

       return redirect()->route('items.index')->with('success', 'Item created successfully.');
   }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $item = $itemRepository->find($id);

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $item = $itemRepository->find($id);

        return view('items.edit', compact('item'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'count' => 'required|integer'
        ]);
  
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $item = $itemRepository->find($id);
  
        $item->setItemName($validated['item_name']);
        $item->setAmount($validated['amount']);
        $item->setCount($validated['count']);

        $this->entityManager->persist($item);
        $this->entityManager->flush();
  
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
  }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
        $itemRepository = $this->entityManager->getRepository(Item::class);
        $item = $itemRepository->find($id);

        if ($item) {
            $this->entityManager->remove($item);
            $this->entityManager->flush();
        }

       return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
   }
}
