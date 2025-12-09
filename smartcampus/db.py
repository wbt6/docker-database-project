# db.py
import asyncpg
DB={ 'user':'student','password':'student123','database':'smartcampusdb','host':'localhost','port':5432 }
_pool=None
async def get_pool():
    global _pool
    if not _pool:
        try: _pool=await asyncpg.create_pool(**DB)
        except: return None
    return _pool
